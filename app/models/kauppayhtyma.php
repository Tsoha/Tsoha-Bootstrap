<?php
class Kauppayhtyma extends BaseModel{
    // Attribuutit
    public $id, $nimi, $bonus;
    // Konstruktori
    public function __construct($attributes){
    	parent:: __construct($attributes);
    }
    public static function all(){
    	 // Alustetaan kysely tietokantayhteydellämme
	    $query = DB::connection()->prepare('SELECT * FROM Kauppayhtyma');
	    // Suoritetaan kysely
	    $query->execute();
	    // Haetaan kyselyn tuottamat rivit
	    $rows = $query->fetchAll();
	    $kauppayhtymat = array();

	    // Käydään kyselyn tuottamat rivit läpi
	    foreach($rows as $row){
	      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
	      $kauppayhtymat[] = new Kauppayhtyma(array(
	        'id' => $row['id'],
	        'nimi' => $row['nimi'],
	        'bonus' => $row['bonus']
	      ));
	    }

	    return $kauppayhtymat;
    }
    public static function find($id){
	    $query = DB::connection()->prepare('SELECT * FROM Kauppayhtyma WHERE id = :id LIMIT 1');
	    $query->execute(array('id' => $id));
	    $row = $query->fetch();

	    if($row){
	      $kauppayhtyma[] = new Kauppayhtyma(array(
	        'id' => $row['id'],
	        'nimi' => $row['nimi'],
	        'bonus' => $row['bonus']
	      ));

	      return $kauppayhtyma;
	    }

	    return null;
	}    
	 
	public function save(){
	    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
	    $query = DB::connection()->prepare('INSERT INTO Kauppayhtyma (nimi, bonus) VALUES (:nimi, :bonus) RETURNING id');
	    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
	    $query->execute(array('nimi' => $this->nimi, 'bonus' => $this->bonus));
	    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
	    $row = $query->fetch();
	    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
	    $this->id = $row['id'];
	}
}
