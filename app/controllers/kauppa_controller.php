<?php
class KauppaController extends BaseController{
  public static function uusi_kauppa(){
      View::make('/suunnitelmat/kaupat/uusi_kauppa.html');
    }
  public static function index(){
    // Haetaan kaikki kaupat tietokannasta
    $kaupat = Kauppa::all();
    // Renderöidään views/suunnitelmat kansiossa sijaitseva tiedosto kauppa.html muuttujan $kaupat datalla
    View::make('suunnitelmat/kaupat/kaupat.html', array('kaupat' => $kaupat));
  }
  public static function show($id){
    // Haetaan kaikki kaupat tietokannasta
    $kauppa = Kauppa::find($id);
    // Renderöidään views/suunnitelmat kansiossa sijaitseva tiedosto kauppa.html muuttujan $kaupat datalla
    View::make('suunnitelmat/kaupat/kauppa.html', array('kauppa' => $kauppa));
  }
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Kauppa-luokan olion käyttäjän syöttämillä arvoilla
    $kauppa = new Kauppa(array(
      'nimi' => $params['nimi'],
      'osoite' => $params['osoite'],
      'kauppayhtyma' => $params['kauppayhtyma']
    ));

    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $kauppa->save();

    // Ohjataan käyttäjä lisäyksen jälkeen kaupan esittelysivulle
    Redirect::to('/kaupat/' . $kauppa->id, array('message' => 'Kauppa on lisätty tietokantaan!'));
  }
  
}