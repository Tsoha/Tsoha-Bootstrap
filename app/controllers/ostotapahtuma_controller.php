<?php
class OstotapahtumaController extends BaseController{
  public static function uusi_ostotapahtuma(){
      View::make('/suunnitelmat/ostotapahtumat/uusi_ostotapahtuma.html');
    }
    public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Ostotapahtuma-luokan olion käyttäjän syöttämillä arvoilla
    $ostotapahtuma = new Ostotapahtuma(array(
      'tuote_id' => $params['tuote_id'],
      'kauppa_id' => $params['kauppa_id'],
      'hinta' => $params['hinta'],
      'ostohetki' => $params['ostohetki']
    ));

    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $ostotapahtuma->save();

    // Ohjataan käyttäjä lisäyksen jälkeen kaupan esittelysivulle
    Redirect::to('/tuotehaku' , array('message' => 'Kauppa on lisätty tietokantaan!'));
    }
}  