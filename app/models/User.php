<?php

class User extends BaseModel {
    
    public $id, $name, $password;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if($row){
            $user = new User(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
            return $user;
        }else{
            return null;
        }
    }
    
    public function authenticate($name, $pw) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE name = :name AND password = :password LIMIT 1');
        $query->execute(array('name' => $name, 'password' => $pw));
        $row = $query->fetch();
        if($row){
            $user = new User(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
            return $user;
        }else{
            return null;
        }
    }
}

