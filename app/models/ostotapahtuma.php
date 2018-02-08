<?php
class Ostotapahtuma extends BaseModel{
    // Attribuutit
    public $tuote_id, $kauppa_id, $hinta, $ostohetki;
    // Konstruktori
    public function __construct($attributes){
    	parent::__construct($attributes);
    }
    public static function tuotteella($id){
    	 // Alustetaan kysely tietokantayhteydellämme
	    $query = DB::connection()->prepare('SELECT * FROM Ostotapahtuma WHERE tuote_id = :id LIMIT 1');
	    // Suoritetaan kysely
	    $query->execute();
	    // Haetaan kyselyn tuottamat rivit
	    $rows = $query->fetchAll();
	    $kaupat = array();

	    // Käydään kyselyn tuottamat rivit läpi
	    foreach($rows as $row){
	      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
	      $ostot[] = new Ostotapahtuma(array(
	        'tuote_id' => $row['tuote_id'],
	        'kauppa_id' => $row['kauppa_id'],
	        'hinta' => $row['hinta'],
	        'ostohetki' => $row['ostohetki']
	      ));
	    }

	    return $ostot;
    }
    public function save(){
	    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
	    $query = DB::connection()->prepare('INSERT INTO Ostotapahtuma (tuote_id, kauppa_id, hinta, ostohetki) VALUES (:tuote_id, :kauppa_id, :hinta, :ostohetki) RETURNING id');
	    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
	    $query->execute(array('tuote_id' => $this->tuote_id, 'kauppa_id' => $this->kauppa_id, 'hinta' => $this->hinta, 'ostohetki' => $this->ostohetki));
	    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
	    $row = $query->fetch();
	    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
	    $this->id = $row['id'];
	}
}    