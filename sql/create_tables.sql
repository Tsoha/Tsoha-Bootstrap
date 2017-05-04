CREATE TABLE User(
  User_id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Askare(
  Askare_id SERIAL PRIMARY KEY,
  User_id SERIAL REFERENCES User(User_id),
  head varchar(50) NOT NULL,
  deadline DATE,
  people varchar(50),
  status varchar(50),
  added DATE,
  description varchar(400)
);

CREATE TABLE Luokka (
	Luokka_id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL,
	User_id SERIAL REFERENCES User(User_id),
	Askare_id SERIAl REFERENCES Askare(Askare_id)
)
