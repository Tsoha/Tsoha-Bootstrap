<?php

/**
 * Luokka kannassa oleville palveluille. Palvelulla on nimi, hinta, kuvaus sekä
 *  sitä tarjoavat työntekijät jotka löytyvät offered_services taulusta.
 *
 * @author johanna
 */
class Service extends BaseModel {

    public $id, $name, $price, $description;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {

        $query = DB::connection()->prepare('SELECT * FROM Service');
        $query->execute();

        $rows = $query->fetchAll();
        $services = array();

        foreach ($rows as $row) {
            $services[] = new Service(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'price' => $row['price'],
                'description' => $row['description']
            ));
        }
        return $services;
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM Service WHERE  id = :id LIMIT 1');

        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $service = new Service(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'price' => $row['price'],
                'description' => $row['description']
            ));
        }
        return $service;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Service (name, price, description) VALUES (:name, :price, :description) RETURNING id');
        
        $query->execute(array('name' => $this->name, 'price' => $this->price, 'description' => $this->description));
        
        $row = $query->fetch();
        
        $this->id = $row['id'];
    }

//    public static function createService($row) {
//
//        $service = new Service(array(
//            'id' => $row['id'],
//            'name' => $row['name'],
//            'price' => $row['price'],
//            'description' => $row['description']
//        ));
//        return $service;
//    }
}
