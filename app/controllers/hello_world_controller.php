<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('/suunnitelmat/tuotehaku.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      // Kint-luokan dump-metodi tulostaa muuttujan arvon
      View::make('helloworld.html');
    }

    public static function kaupat(){
      // Testaa koodiasi täällä
      View::make('/suunnitelmat/kaupat.html');
    }

    public static function tuotehaku(){
      // Testaa koodiasi täällä
      View::make('/suunnitelmat/tuotehaku.html');
    }

    public static function tuotteet(){
      // Testaa koodiasi täällä
      View::make('/suunnitelmat/tuotteet.html');
    }

    public static function uusi_tuote(){
      // Testaa koodiasi täällä
      View::make('/suunnitelmat/uusi_tuote.html');
    }

    public static function uusi_kauppa(){
      // Testaa koodiasi täällä
      View::make('/suunnitelmat/uusi_kauppa.html');
    }

    public static function kauppayhtymat(){
      // Testaa koodiasi täällä
      View::make('/suunnitelmat/kauppayhtymat.html');
    }

    public static function uusi_kauppayhtyma(){
      // Testaa koodiasi täällä
      View::make('/suunnitelmat/uusi_kauppayhtyma.html');
    }
  }
