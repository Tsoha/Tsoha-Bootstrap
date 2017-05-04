INSERT INTO Employee (name, startingDate, special, introduction) VALUES ('Jack Bauer', '2013-04-01', 'Parturipalvelut', 'Ei koskaan anna periksi');
INSERT INTO Employee (name, startingDate, special, introduction) VALUES ('Elmo', '2011-06-22', 'Värjäys', 'Pehmo');
INSERT INTO Employee (name, startingDate, special, introduction) VALUES ('Jossu', '2015-07-03', 'Opiskelijatyöt', 'Noobi');
INSERT INTO Employee (name, startingDate, special, introduction) VALUES ('Elmo', '2011-06-22', 'Värjäys', 'Pehmo');


INSERT INTO Service (name, price, description) VALUES ('Hiustenleikkuu - Lyhyet', '15', 'Lyhyiden hiusten leikkuu ja mallin palautus');
INSERT INTO Service (name, price, description) VALUES ('Hiustenleikkuu - Keskipitkät', '30', 'Keskipitkien hiusten leikkuu ja mallin palautus');
INSERT INTO Service (name, price, description) VALUES ('Hiustenleikkuu - Lyhyet', '40', 'Pitkien hiusten leikkuu ja mallin palautus');
INSERT INTO Service (name, price, description) VALUES ('Ajo/Otsatukan tasaus', '10', 'Pään ajo koneella tai otsatukan tasaus.');

INSERT INTO Offered_Services (employeeID, serviceID) VALUES ('1', '1');
INSERT INTO Offered_Services (employeeID, serviceID) VALUES ('1', '2');
INSERT INTO Offered_Services (employeeID, serviceID) VALUES ('1', '3');
INSERT INTO Offered_Services (employeeID, serviceID) VALUES ('1', '4');
INSERT INTO Offered_Services (employeeID, serviceID) VALUES ('2', '1');
INSERT INTO Offered_Services (employeeID, serviceID) VALUES ('2', '2');
INSERT INTO Offered_Services (employeeID, serviceID) VALUES ('4', '4');

DELETE FROM Employee WHERE id = 2;

INSERT INTO Client (firstName, lastName, email, phoneNumber) VALUES ('pöllö', 'pöllönen', 'asd@asd.asd', '12312313');

INSERT INTO Workshift (date, start, endtime, employeeID) VALUES ('2015-08-04','08:00:00','18:00:00','3');

INSERT INTO Reservation (clientID, serviceID, employeeID, date, start, endtime, message) VALUES ('1', '2', '3','2015-08-04','12:00:00','13:00:00','HIRVEET TÖYHTÖT HALUUN');

INSERT INTO Access (employeeId, access) VALUES ('3', 'true'); 


