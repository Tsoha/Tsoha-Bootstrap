<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('login.html');
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        View::make('helloworld.html');
    }

    public static function memorylist() {
        View::make('memorylist.html');
    }

    public static function login() {
        View::make('login.html');
    }

    public static function edit_memory() {
        View::make('edit_memory.html');
    }

    public static function memo_page() {
        View::make('memo_page.html');
    }

    public static function reg() {
        View::make('reg.html');
    }

}
