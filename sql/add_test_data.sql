INSERT INTO Kayttaja (name, password) VALUES ('Pekka', 'Pekka123');
INSERT INTO Kayttaja (name, password) VALUES ('Maija', 'Maija123');

INSERT INTO Luokka (luokka_name, description, kayttaja_id) VALUES ('Kotityöt', 'Asunnosta huolehtimiseen tarvittavat askareet, joista kaikki ovat yhteisesti vastuussa.', '1');
INSERT INTO Luokka (luokka_name, description, kayttaja_id) VALUES ('Kotitehtävät', 'Kurssien tehtävät, jotka täytyy tehdä, jotta menestyy kurssilla.', '1');
INSERT INTO Luokka (luokka_name, description, kayttaja_id) VALUES ('Lemmikkieläimet', 'Lemmikkieläinten huolehtimisen askareet.', '2');

INSERT INTO Askare (name, description, deadline, importance, added, kayttaja_id) VALUES ('Tee tiskit', 'Yhdessä aiheutettujen tiskien tiskaaminen käsin. Luo harmoniaa.', '2017-05-14', '10', NOW(), '1');
INSERT INTO Askare (name, description, deadline, importance, added, kayttaja_id) VALUES ('Imurointi', 'Talouden imurointi läpikotaisin', '2017-05-12', '8', NOW(), '1');

INSERT INTO Askare (name, description, deadline, importance, added, kayttaja_id) VALUES ('Kissan pesu', 'Kissa täytyy pestä sen vastalauseista huolimatta', '2017-05-16', '15', NOW(), '2');
INSERT INTO Askare (name, description, deadline, importance, added, kayttaja_id) VALUES ('Koiran ulkoiluttaminen', 'Koiran vieminen ulos ja sen kävelyttäminen', '2017-05-15', '9', NOW(), '2');

INSERT INTO Askare_luokka (askare_id, luokka_id) VALUES (1, 1);
INSERT INTO Askare_luokka (askare_id, luokka_id) VALUES (2, 1);
INSERT INTO Askare_luokka (askare_id, luokka_id) VALUES (3, 3);
INSERT INTO Askare_luokka (askare_id, luokka_id) VALUES (4, 3);
