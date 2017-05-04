
CREATE TABLE Employee(
id SERIAL PRIMARY KEY,
name varchar(30) NOT NULL,
startingDate DATE,
special varchar(120),
introduction varchar(500)
);

CREATE TABLE Service(
id SERIAL PRIMARY KEY,
name varchar(30) NOT NULL,
price INTEGER NOT NULL,
description varchar(500)
);

CREATE TABLE Offered_Services(
serviceID integer REFERENCES Service ON DELETE CASCADE,
employeeID integer REFERENCES Employee ON DELETE CASCADE,
PRIMARY KEY (serviceID, employeeID)
);

CREATE TABLE Client(
ID SERIAL PRIMARY KEY,
firstName varchar(30) NOT NULL,
lastName varchar(30) NOT NULL,
email varchar(30) NOT NULL,
phoneNumber varchar(20) NOT NULL,
username varchar(20),
password varchar(50)
);

CREATE TABLE Workshift(
id SERIAL PRIMARY KEY,
date DATE NOT NULL,
start TIME NOT NULL,
endtime TIME NOT NULL,
employeeID Integer REFERENCES Employee ON DELETE CASCADE
);

CREATE TABLE Reservation(
id SERIAL PRIMARY KEY,
clientID integer REFERENCES Client NOT NULL,
serviceID integer REFERENCES Service DEFAULT 1,
employeeID integer REFERENCES Employee NOT NULL,
date DATE NOT NULL,
start TIME NOT NULL,
endtime TIME NOT NULL,
message varchar(1000)
);


CREATE TABLE Access(
id SERIAL PRIMARY KEY,
employeeID Integer REFERENCES Employee ON DELETE CASCADE,
access boolean DEFAULT FALSE
);

