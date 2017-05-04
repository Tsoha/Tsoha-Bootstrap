<?php

class Askare extends BaseModel {
    
    public $id, $name, $luokka, $done, $description, $added, $deadline, $importance, $kayttaja_id, $validators;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_luokka', 'validate_deadline', 'validate_description', 'validate_importance', 'validate_kayttaja_id');
    }
    
    public static function all($user_id){
        $query = DB::connection()->prepare('SELECT * FROM Askare WHERE kayttaja_id = :user_id');
        $query->execute(array('user_id' => $user_id));
        $rows = $query->fetchAll();
        $tasks = array();
        
        foreach($rows as $row) {
            $tasks[] = new Askare(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'luokka' => Luokka::askare($row['id']),
//                'done' => $row['done'],
                'description' => $row['description'],
                'added' => $row['added'],
                'deadline' => $row['deadline'],
                'importance' => $row['importance']
                ));
        }
        return $tasks;
    }
    
    public static function find($id, $user_id) {
        $query = DB::connection()->prepare('SELECT * FROM Askare WHERE id = :id AND kayttaja_id = :user_id LIMIT 1');
        $query->execute(array('id' => $id, 'user_id' => $user_id));
        $row = $query->fetch();
//        $luokat = Luokka::askare( $this->id);
        
        if($row){
            $task = new Askare(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'luokka' => Luokka::askare($row['id']),
//                'done' => $row['done'],
                'description' => $row['description'],
                'added' => $row['added'],
                'deadline' => $row['deadline'],
                'importance' => $row['importance']
            ));
            return $task;
        }
        
        return null;
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Askare (name, description, deadline, importance, added, kayttaja_id) VALUES (:name, :description, :deadline, :importance, :added, :user_id) RETURNING id');
        $query->execute(array('name' => $this->name, 'description' => $this->description, 'deadline' => $this->deadline, 'importance' => $this->importance, 'added' => $this->added, 'user_id' => $this->kayttaja_id));
        $row = $query->fetch();
//        Kint::trace();
//        Kint::dump($row);
        $this->id = $row['id'];
        foreach ($this->luokka as $luokkab) {
            $query2 = DB::connection()->prepare('INSERT INTO Askare_luokka (askare_id, luokka_id) VALUES (:askare, :luokka) RETURNING oma_id');
            $query2->execute(array('askare' => $this->id, 'luokka' => $luokkab));
        }
    }
    
    public function update() {
        $this->deleteLuokat();
        $query = DB::connection()->prepare('UPDATE Askare SET name = :name, description = :description, deadline = :deadline, importance = :importance WHERE id = :id');
        $query->execute(array('id' => $this->id, 'name' => $this->name, 'description' => $this->description, 'deadline' => $this->deadline, 'importance' => $this->importance));
        foreach ($this->luokka as $luokkab) {
            $query2 = DB::connection()->prepare('INSERT INTO Askare_luokka (askare_id, luokka_id) VALUES (:askare, :luokka) RETURNING oma_id');
            $query2->execute(array('askare' => $this->id, 'luokka' => $luokkab));
        }
        
    }
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Askare WHERE id = :id');
        $query->execute(array('id' => $this->id));
        $this->deleteLuokat();
    }
    
    public function deleteLuokat() {
        $query = DB::connection()->prepare('DELETE FROM Askare_luokka WHERE askare_id = :id');
        $query->execute(array('id' => $this->id));
    }
    
    public function validate_string_length($string, $length){
        if (strlen($string) < $length) {
            return true;
        } else {
            return false;
        }
    }
    
    public function validate_string_shorter($string, $length){
        if (strlen($string) > $length) {
            return true;
        } else {
            return false;
        }
    }
    
    function validate_date_format($dt){
        $day = DateTime::createFromFormat('Y-m-d', $dt);
        return $day && $day->format('Y-m-d') === $dt;
    }
    
    function validate_date($dt){
        $day = date_parse($dt);
        if ($day["error_count"] === 0 && checkdate($day["month"], $day["day"], $day["year"])){
            return true;
        } else {
            return false;
        }
    }
    
    public function validate_name(){
        $errors = array();
        if($this->name == '' || $this->name == null){
            $errors[] = 'Askareen nimi ei saa olla tyhjä!';
        }
        if($this->validate_string_length($this->name, 3)){
            $errors[] = 'Askareen nimen pituuden täytyy olla vähintään kolme merkkiä';
        }
        if($this->validate_string_shorter($this->name, 50)){
            $errors[] = 'Askareen nimen pituus saa olla korkeintaan 50 merkkiä.';
        }
        return $errors;
    }
    
    public function validate_luokka(){
        $errors = array();
        foreach ($this->luokka as $luokkab) {
            if($luokkab == '' || $luokkab == null){
                $errors[] = 'Luokka ei voi olla tyhjä!';
            }
        }
//        if($this->validate_string_length($this->luokka, 3)){
//            $errors[] = 'Luokan pituuden täytyy olla vähintään kolme merkkiä';
//        }
        return $errors;
    }
    
    public function validate_deadline(){
        $errors = array();
//        if($this->deadline == '' || $this->deadline == null){
//            $errors[] = 'Deadline ei saa olla tyhjä!';
//        }
        if(!$this->validate_date_format($this->deadline) && !$this->validate_date($this->deadline)){
            $errors[] = 'Deadlinen täytyy olla päivämäärä muodossa yyyy-mm-dd!';
        }
        return $errors;
    }
    
    public function validate_description(){
        $errors = array();
        if($this->description == '' || $this->description == null){
            $errors[] = 'Kuvaus ei saa olla tyhjä!';
        }
        if($this->validate_string_length($this->description, 3)){
            $errors[] = 'Kuvauksen pituuden täytyy olla vähintään kolme merkkiä';
        }
        if($this->validate_string_shorter($this->description, 400)){
            $errors[] = 'Kuvauksen pituus saa olla korkeintaan 400 merkkiä.';
        }
        return $errors;
    }
    
    public function validate_importance(){
        $errors = array();
        if($this->importance == '' || $this->importance == null){
            $errors[] = 'Tärkeysaste ei saa olla tyhjä!';
        }
        if(!is_numeric($this->importance)){
            $errors[] = 'Tärkeysasteen täytyy olla luku!';
        }
        if($this->validate_string_shorter($this->name, 400)){
            $errors[] = 'Kuvauksen pituus saa olla korkeintaan 400 merkkiä.';
        }
        return $errors;
    }
    
    public function validate_kayttaja_id() {
        $errors = array();
        return $errors;
    }
}

