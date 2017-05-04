<?php

require 'app/models/Service.php';
class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        //  View::make('home.html');
        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
//        echo 'Hello World!';
        $service = Service::find(1);
        $services = Service::all();
        
        Kint::dump($service);
        Kint::dump($services);
        
//        View::make('helloworld.html');
    }

    public static function etusivu() {
        View::make('suunnitelmat/etusivu.html');
    }

    public static function service_list() {
        View::make('suunnitelmat/palvelulista.html');
    }

    public static function employee_list() {
        View::make('suunnitelmat/tyontekijat.html');
    }

    public static function employee_show() {
        View::make('suunnitelmat/tyontekija.html');
    }
    public static function employee_edit() {
         View::make('suunnitelmat/muokkaatyontekija.html');
    }

}
