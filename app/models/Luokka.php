<?php

class Luokka extends BaseModel {
    
    public $luokka_id, $luokka_name, $description, $kayttaja_id, $validators;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_luokka_name', 'validate_kayttaja_id', 'validate_description');
    }
    
    public static function all($user_id){
        $query = DB::connection()->prepare('SELECT * FROM Luokka WHERE kayttaja_id = :user_id');
        $query->execute(array('user_id' => $user_id));
        $rows = $query->fetchAll();
        $luokat = array();
        
        foreach($rows as $row) {
            $luokat[] = new Luokka(array(
                'luokka_id' => $row['luokka_id'],
                'luokka_name' => $row['luokka_name'],
                'description' => $row['description']
                ));
        }
        return $luokat;
    }
    
    public static function find($luokka_id, $user_id) {
        $query = DB::connection()->prepare('SELECT * FROM Luokka WHERE luokka_id = :luokka_id AND kayttaja_id = :user_id LIMIT 1');
        $query->execute(array('luokka_id' => $luokka_id, 'user_id' => $user_id));
        $row = $query->fetch();
        
        if($row){
            $class = new Luokka(array(
                'luokka_id' => $row['luokka_id'],
                'luokka_name' => $row['luokka_name'],
                'description' => $row['description']
            ));
            return $class;
        }
        
        return null;
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Luokka (luokka_name, description, kayttaja_id) VALUES (:luokka_name, :description, :user_id) RETURNING luokka_id');
        $query->execute(array('luokka_name' => $this->luokka_name, 'description' => $this->description, 'user_id' => $this->kayttaja_id));
        $row = $query->fetch();
//        Kint::trace();
//        Kint::dump($row);
        $this->luokka_id = $row['luokka_id'];
    }
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Luokka SET luokka_name = :luokka_name, description = :description WHERE luokka_id = :luokka_id');
        $query->execute(array('luokka_id' => $this->luokka_id, 'luokka_name' => $this->luokka_name, 'description' => $this->description));
        
    }
    
    public function destroy() {
        $this->deleteAskareet();
        $query = DB::connection()->prepare('DELETE FROM Luokka WHERE luokka_id = :luokka_id');
        $query->execute(array('luokka_id' => $this->luokka_id));
    }
    
    public function deleteAskareet() {
        $query = DB::connection()->prepare('DELETE FROM Askare_luokka WHERE luokka_id = :id');
        $query->execute(array('id' => $this->luokka_id));
    }
    
    public static function one($luokka_id, $user_id){
        $query = DB::connection()->prepare('SELECT a.id, a.kayttaja_id FROM Askare a JOIN Askare_luokka al ON a.id = al.askare_id JOIN Luokka l ON :luokka_id = al.luokka_id AND :user_id = l.kayttaja_id GROUP BY a.kayttaja_id, a.id');
        $query->execute(array('luokka_id' => $luokka_id, 'user_id' => $user_id));
        $rows = $query->fetchAll();
        $tasks = array();
        
        foreach($rows as $row) {
            $tasks[] = Askare::find($row['id'], $row['kayttaja_id']);
        }
        return $tasks;
    }
    
    public static function askare($askare_id){
        $query = DB::connection()->prepare('SELECT l.luokka_name FROM Luokka l JOIN Askare_luokka al ON l.luokka_id = al.luokka_id JOIN Askare a ON :askare_id = al.askare_id GROUP BY l.luokka_name');
        $query->execute(array('askare_id' => $askare_id));
        $rows = $query->fetchAll();
        $luokat = array();
        
        foreach($rows as $row) {
            $luokat[] = $row['luokka_name'];
        }
        return $luokat;
    }
    
    public static function askareid($askare_id){
        $query = DB::connection()->prepare('SELECT l.luokka_id FROM Luokka l JOIN Askare_luokka al ON l.luokka_id = al.luokka_id JOIN Askare a ON :askare_id = al.askare_id GROUP BY l.luokka_id');
        $query->execute(array('askare_id' => $askare_id));
        $rows = $query->fetchAll();
        $luokat = array();
        
        foreach($rows as $row) {
            $luokat[] = $row['luokka_id'];
        }
        return $luokat;
    }
    public static function luokkaname($luokka_id){
        $query = DB::connection()->prepare('SELECT luokka_name FROM Luokka WHERE luokka_id = :luokka_id LIMIT 1');
        $query->execute(array('luokka_id' => $luokka_id));
        $row = $query->fetch();
        if($row){
            $luokka = $row['luokka_name'];
            return $luokka;
        } else {
            return null;
        }
    }
    
    public function validate_luokka_name(){
        $errors = array();
        if($this->luokka_name == '' || $this->luokka_name == null){
            $errors[] = 'Luokan nimi ei saa olla tyhjä!';
        }
        if($this->validate_string_length($this->luokka_name, 3)){
            $errors[] = 'Luokan pituuden täytyy olla vähintään kolme merkkiä';
        }
        
        if($this->validate_string_shorter($this->luokka_name, 50)){
            $errors[] = 'Luokan pituus saa olla korkeintaan 50 merkkiä';
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
            $errors[] = 'Kuvauksen pituus saa olla korkeintaan 400 merkkiä';
        }
        return $errors;
    }
    
    public function validate_kayttaja_id() {
        $errors = array();
        return $errors;
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
}