-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kauppayhtyma (nimi, bonus) VALUES ('k-ketju', '0.05');

INSERT INTO Kauppa (nimi, osoite) VALUES ('kauppanen', 'testikatu 16');
INSERT INTO Kauppa (nimi, osoite) VALUES ('toinenkauppanen', 'testikatu 18');

INSERT INTO Tuote (nimi) VALUES ('kurkku');

INSERT INTO Ostotapahtuma (kauppa_id, tuote_id, hinta) VALUES ('1', '1', '15.89');