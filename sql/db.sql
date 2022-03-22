CREATE TABLE elokuvat (
  elokuva_id int AUTO_INCREMENT,
  elokuva_nimi varchar(255) not null,
  elokuva_tulovuosi integer,
  elokuva_kesto integer,
  elokuva_kieli varchar(255),
  ohjaaja_id integer,
  ikaraja int,
  PRIMARY KEY (elokuva_id),
  FOREIGN KEY (ohjaaja_id) REFERENCES ohjaaja(ohjaaja_id)

) 

CREATE TABLE ohjaaja (
  ohjaaja_id int AUTO_INCREMENT,
  ohjaaja_enimi varchar(255),
  ohjaaja_snimi varchar(255),
  primary key (ohjaaja_id)
) 

CREATE TABLE arvostelut (
  elokuva_id integer not null,
  arvostelija varchar(255),
  tahdet int not null,
  kommentti varchar(255),
  FOREIGN KEY (elokuva_id) REFERENCES elokuvat(elokuva_id)
) 

CREATE TABLE nayttelija (
  nayttelija_id int AUTO_INCREMENT,
  nayttelija_enimi varchar(255) not null,
  nayttelija_snimi varchar(255) not null,
  nayttelija_sex varchar(2) not null,
  PRIMARY KEY (nayttelija_id)
) 

CREATE TABLE nayttelija_cast (
  nayttelija_id int not null,
  elokuva_id int not null,
  rooli varchar(30),
  FOREIGN KEY (nayttelija_id) REFERENCES nayttelijat(nayttelija_id)
) 

CREATE TABLE genret(
  gen_id int NOT NULL AUTO_INCREMENT,
  gen_nimi varchar(20) NOT NULL,
  PRIMARY KEY(gen_id)
);
CREATE TABLE elokuva_genret(
  elokuva_id int NOT NULL,
  gen_id int NOT NULL,
  FOREIGN KEY (elokuva_id) REFERENCES elokuvat(elokuva_id),
  FOREIGN KEY (gen_id) REFERENCES genret(gen_id)
);