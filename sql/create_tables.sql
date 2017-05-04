CREATE TABLE Kayttaja(
id SERIAL PRIMARY KEY,
name varchar(50) NOT NULL,
password varchar(50) NOT NULL
);

CREATE TABLE Luokka(
luokka_id SERIAL PRIMARY KEY,
kayttaja_id INTEGER REFERENCES Kayttaja (id),
luokka_name varchar(50) NOT NULL,
description varchar(400)
);

CREATE TABLE Askare(
id SERIAL PRIMARY KEY,
kayttaja_id INTEGER REFERENCES Kayttaja (id),
name varchar(50) NOT NULL,
description varchar(400),
added DATE,
deadline DATE,
importance INTEGER
);

CREATE TABLE Askare_luokka(
oma_id SERIAL PRIMARY KEY,
askare_id integer REFERENCES Askare (id) ON UPDATE CASCADE ON DELETE CASCADE,
luokka_id integer REFERENCES Luokka (luokka_id) ON UPDATE CASCADE
);