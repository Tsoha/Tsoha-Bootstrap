<?php

/**
 * Vastaa muista mahdollisista sivustoon liittyvistä kontrollereista.
 */
class SiteController extends BaseController {

    public static function index() {
        View::make('index.html');
    }

    public static function employee() {
        View::make('employee/index.html');
    }

    public static function login() {
        View::make('login/index.html');
    }

    public static function register() {
        View::make('register/index.html');
    }

    public static function reservation() {
        View::make('reservation/index.html');
    }

    public static function workhours() {
        View::make('workhours/index.html');
    }

}
