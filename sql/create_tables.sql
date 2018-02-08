-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kauppayhtyma(
	id SERIAL PRIMARY KEY,
	nimi varchar(75) NOT NULL,
	bonus DECIMAL DEFAULT 0
);

CREATE TABLE Kauppa(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  nimi varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  osoite varchar(100),
  kauppayhtyma_id INTEGER REFERENCES Kauppayhtyma(id)
);

CREATE TABLE Tuote(
  id SERIAL PRIMARY KEY, 
  nimi varchar(50) NOT NULL
);

CREATE TABLE Ostotapahtuma(
  id SERIAL PRIMARY KEY, 
  tuote_id INTEGER REFERENCES Tuote(id) NOT NULL, --Viiteavain Tuote-tauluun
  kauppa_id INTEGER REFERENCES Kauppa(id) NOT NULL, --Viiteavain Kauppa-tauluun
  hinta MONEY NOT NULL, --kilo-/litrahinta
  ostohetki timestamp --ostohetki
);