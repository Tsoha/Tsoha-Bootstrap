<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        View::make('helloworld.html');
    }
     public static function memorylist(){
    View::make('suunnitelmat/memorylist.html');
  }

  public static function login(){
    View::make('suunnitelmat/login.html');
  }

  public static function edit_memory(){
    View::make('suunnitelmat/edit_memory.html');
  }
  public static function memo_page(){
    View::make('suunnitelmat/memo_page.html');
  }

  public static function reg(){
    View::make('suunnitelmat/reg.html');
  }


}
