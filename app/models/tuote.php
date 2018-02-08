<?php
class Tuote extends BaseModel{
    // Attribuutit
    public $id, $nimi;
    // Konstruktori
    public function __construct($attributes){
    	parent::__construct($attributes);
    }
    public static function all(){
    	 // Alustetaan kysely tietokantayhteydellämme
	    $query = DB::connection()->prepare('SELECT * FROM Tuote');
	    // Suoritetaan kysely
	    $query->execute();
	    // Haetaan kyselyn tuottamat rivit
	    $rows = $query->fetchAll();
	    $tuotteet = array();

	    // Käydään kyselyn tuottamat rivit läpi
	    foreach($rows as $row){
	      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
	      $tuotteet[] = new Tuote(array(
	        'id' => $row['id'],
	        'nimi' => $row['nimi']
	      ));
	    }

	    return $tuotteet;
    }
    public static function find($id){
	    $query = DB::connection()->prepare('SELECT * FROM Tuote WHERE id = :id LIMIT 1');
	    $query->execute(array('id' => $id));
	    $row = $query->fetch();

	    if($row){
	      $tuote[] = new Tuote(array(
	        'id' => $row['id'],
	        'nimi' => $row['nimi']
	      ));

	      return $tuote;
	    }

	    return null;
	  }
	public function save(){
	    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
	    $query = DB::connection()->prepare('INSERT INTO Tuote (nimi) VALUES (:nimi) RETURNING id');
	    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
	    $query->execute(array('nimi' => $this->nimi));
	    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
	    $row = $query->fetch();
	    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
	    $this->id = $row['id'];
	  }  
}