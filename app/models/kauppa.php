<?php
class Kauppa extends BaseModel{
    // Attribuutit
    public $id, $nimi, $osoite, $kauppayhtyma_id;
    // Konstruktori
    public function __construct($attributes){
    	parent::__construct($attributes);
    }
    public static function all(){
    	 // Alustetaan kysely tietokantayhteydellämme
	    $query = DB::connection()->prepare('SELECT * FROM Kauppa');
	    // Suoritetaan kysely
	    $query->execute();
	    // Haetaan kyselyn tuottamat rivit
	    $rows = $query->fetchAll();
	    $kaupat = array();

	    // Käydään kyselyn tuottamat rivit läpi
	    foreach($rows as $row){
	      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
	      $kaupat[] = new Kauppa(array(
	        'id' => $row['id'],
	        'nimi' => $row['nimi'],
	        'osoite' => $row['osoite'],
	        'kauppayhtyma' => $row['kauppayhtyma_id']
	      ));
	    }

	    return $kaupat;
    }
    public static function find($id){
	    $query = DB::connection()->prepare('SELECT * FROM Kauppa WHERE id = :id LIMIT 1');
	    $query->execute(array('id' => $id));
	    $row = $query->fetch();

	    if($row){
	      $kauppa[] = new Kauppa(array(
	        'id' => $row['id'],
	        'nimi' => $row['nimi'],
	        'osoite' => $row['osoite'],
	        'kauppayhtyma_id' => $row['kauppayhtyma_id']
	      ));

	      return $kauppa;
	    }

	    return null;
	  }
	public function save(){
	    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
	    $query = DB::connection()->prepare('INSERT INTO Kauppa (nimi, osoite, kauppayhtyma_id) VALUES (:nimi, :osoite, :kauppayhtyma) RETURNING id');
	    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
	    $query->execute(array('nimi' => $this->nimi, 'osoite' => $this->osoite, 'kauppayhtyma' => $this->kauppayhtyma_id));
	    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
	    $row = $query->fetch();
	    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
	    $this->id = $row['id'];
	  }  
}