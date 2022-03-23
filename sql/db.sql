DROP DATABASE IF EXISTS moviedb;

CREATE DATABASE moviedb;

USE moviedb;

CREATE TABLE ohjaaja (
  id int AUTO_INCREMENT,
  etunimi varchar(255),
  sukunimi varchar(255),
  primary key (id)
);

CREATE TABLE genre(
  id int AUTO_INCREMENT,
  nimi varchar(255) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE elokuva (
  id int AUTO_INCREMENT,
  nimi varchar(255) not null,
  vuosi int,
  kesto int,
  kieli varchar(30),
  ikaraja int,
  ohjaaja_id int,
  genre_id int NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (ohjaaja_id) REFERENCES ohjaaja(id),
  FOREIGN KEY (genre_id) REFERENCES genre(id)
);

CREATE TABLE arvostelu (
  elokuva_id int not null,
  arvostelija varchar(30),
  tahdet int not null,
  kommentti varchar(255),
  FOREIGN KEY (elokuva_id) REFERENCES elokuva(id)
);

CREATE TABLE nayttelija (
  id int AUTO_INCREMENT,
  etunimi varchar(255) not null,
  sukunimi varchar(255) not null,
  sukupuoli varchar(10),
  PRIMARY KEY (id)
);

CREATE TABLE nayttelija_rooli (
  nayttelija_id int not null,
  elokuva_id int not null,
  rooli varchar(255),
  FOREIGN KEY (nayttelija_id) REFERENCES nayttelija(id)
);

INSERT INTO genre(nimi) VALUES ('Kauhu');

INSERT INTO ohjaaja(etunimi, sukunimi) VALUES ('Andy', 'Muschietti');

INSERT INTO elokuva (nimi, vuosi, kesto, kieli, ohjaaja_id, ikaraja, genre_id)
  VALUES('IT', 2017, 135, 'Englanti', 1, 16, 1);

INSERT INTO nayttelija (etunimi, sukunimi) 
  VALUES ('Bill', 'Skarsgard'), ('Jaeden', 'Martell'), ('Sophia', 'Lillis'), ('Finn', 'Wolfhard');

INSERT INTO nayttelija_rooli (nayttelija_id, elokuva_id, rooli)
  VALUES (1, 1, 'Pennywise'), (2, 1, 'Bill Denbrough'), (3, 1, 'Beverly Marsh'), (4, 1, 'Richie Tozier');

  INSERT INTO arvostelu(elokuva_id, arvostelija, tahdet, kommentti)
    VALUES (1, 'Saku', 3, 'Hui pelotti ihan viitust');