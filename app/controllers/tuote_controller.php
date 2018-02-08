<?php
class TuoteController extends BaseController{
  public static function tuotehaku(){
    View::make('/suunnitelmat/tuotteet/tuotehaku.html');
  }
  public static function uusi_tuote(){
      View::make('/suunnitelmat/tuotteet/uusi_tuote.html');
    }
  public static function index(){
    // Haetaan kaikki tuotteet tietokannasta
    $tuotteet = Tuote::all();
    // Renderöidään views/suunnitelmat kansiossa sijaitseva tiedosto tuote.html muuttujan $tuotteet datalla
    View::make('suunnitelmat/tuotteet/tuotteet.html', array('tuotteet' => $tuotteet));
  }
  public static function show($id){
    // Haetaan kaikki ostot kyseisestä tuotteesta tietokannasta
    $ostot = Ostotapahtuma::tuotteella($id);
    // Renderöidään views/suunnitelmat/tuotteet kansiossa sijaitseva tiedosto tuote.html muuttujan $ostot datalla
    View::make('suunnitelmat/tuotteet/tuote.html', array('ostot' => $ostot));
  }
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Tuote-luokan olion käyttäjän syöttämillä arvoilla
    $tuote = new Tuote(array(
      'nimi' => $params['nimi']
    ));

    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $tuote->save();

    // Ohjataan käyttäjä lisäyksen jälkeen tuotteiden listaus-sivulle
    Redirect::to('/tuotehaku', array('message' => 'Tuote on lisätty tietokantaan!'));
  }
}