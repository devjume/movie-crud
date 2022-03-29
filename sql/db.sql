DROP DATABASE IF EXISTS moviedb;

CREATE DATABASE moviedb;

USE moviedb;

CREATE TABLE ohjaaja (
  id int AUTO_INCREMENT,
  nimi varchar(255) NOT NULL,
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
  posterilinkki varchar(255),
  PRIMARY KEY (id),
  FOREIGN KEY (ohjaaja_id) REFERENCES ohjaaja(id),
  FOREIGN KEY (genre_id) REFERENCES genre(id),
  CONSTRAINT chk_ikaraja CHECK (ikaraja IS NULL OR ikaraja = 0 OR ikaraja = 7 OR ikaraja = 16 or ikaraja = 18)
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
  sukupuoli varchar(6),
  PRIMARY KEY (id),
  CONSTRAINT chk_sukupuoli CHECK ((sukupuoli in ('Mies', 'Nainen', 'Muu')) OR sukupuoli IS NULL)
);

CREATE TABLE nayttelija_rooli (
  nayttelija_id int not null,
  elokuva_id int not null,
  rooli varchar(255),
  FOREIGN KEY (nayttelija_id) REFERENCES nayttelija(id)
);

INSERT INTO genre(nimi) VALUES ('Kauhu');

INSERT INTO ohjaaja(nimi) VALUES ('Andy Muschietti');

INSERT INTO elokuva (nimi, vuosi, kesto, kieli, ohjaaja_id, ikaraja, genre_id, posterilinkki)
  VALUES('IT', 2017, 135, 'Englanti', 1, 16, 1, "https://m.media-amazon.com/images/M/MV5BZDVkZmI0YzAtNzdjYi00ZjhhLWE1ODEtMWMzMWMzNDA0NmQ4XkEyXkFqcGdeQXVyNzYzODM3Mzg@._V1_.jpg");

INSERT INTO nayttelija (etunimi, sukunimi, sukupuoli) 
  VALUES ('Bill', 'Skarsgard', 'Mies'), ('Jaeden', 'Martell', 'Mies'), ('Sophia', 'Lillis', 'Nainen'), ('Finn', 'Wolfhard', 'Mies');

INSERT INTO nayttelija_rooli (nayttelija_id, elokuva_id, rooli)
  VALUES (1, 1, 'Pennywise'), (2, 1, 'Bill Denbrough'), (3, 1, 'Beverly Marsh'), (4, 1, 'Richie Tozier');

  INSERT INTO arvostelu(elokuva_id, arvostelija, tahdet, kommentti)
    VALUES (1, 'Saku', 3, 'Hui pelotti ihan viitust');
