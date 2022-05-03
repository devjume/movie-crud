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
  kuva_url text,
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
  FOREIGN KEY (nayttelija_id) REFERENCES nayttelija(id),
  FOREIGN KEY (elokuva_id) REFERENCES elokuva(id)
);

CREATE TABLE yllapitaja(  
    ID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(150),
    lastname VARCHAR(150),
    username VARCHAR(150) UNIQUE,
    password VARCHAR(150)
);

INSERT INTO genre(nimi) VALUES ('Kauhu'), ('Draama/Rikos'), ('Toiminta'), ('Mysteeri');

INSERT INTO ohjaaja(nimi) VALUES 
  ('Andy Muschietti'),
  ('Quentin Tarantino'),
  ('Matt Reeves'),
  ('Jon Watts'),
  ('Rian Johnson'),
  ('Todd Phillips');

INSERT INTO elokuva (nimi, vuosi, kesto, kieli, ohjaaja_id, ikaraja, genre_id, kuva_url)
  VALUES('IT', 2017, 135, 'Englanti', 1, 16, 1, 'https://m.media-amazon.com/images/M/MV5BZDVkZmI0YzAtNzdjYi00ZjhhLWE1ODEtMWMzMWMzNDA0NmQ4XkEyXkFqcGdeQXVyNzYzODM3Mzg@._V1_.jpg'),
    ('Pulp Fiction', 1993, 154, 'Englanti', 2, 16, 2, 'https://upload.wikimedia.org/wikipedia/en/3/3b/Pulp_Fiction_%281994%29_poster.jpg'),
    ('The Batman', 2022, 176, 'Englanti', 3, 16, 3, 'https://upload.wikimedia.org/wikipedia/fi/9/9a/The-Batman-2022-Teaser-Poster.jpg'),
    ('Spider-Man: No Way Home',2021, 148, 'Englanti', 4, 16, 3, 'https://upload.wikimedia.org/wikipedia/en/0/00/Spider-Man_No_Way_Home_poster.jpg'),
    ('Knives Out', 2019, 130, 'Englanti',5, 16, 4, 'https://upload.wikimedia.org/wikipedia/en/1/1f/Knives_Out_poster.jpeg' ),
    ('Joker', 2019, 122, 'Englanti', 6, 16, 2, 'https://upload.wikimedia.org/wikipedia/en/e/e1/Joker_%282019_film%29_poster.jpg');

INSERT INTO nayttelija (etunimi, sukunimi, sukupuoli) 
  VALUES 
    ('Bill', 'Skarsgard', 'Mies'), 
    ('Jaeden', 'Martell', 'Mies'), 
    ('Sophia', 'Lillis', 'Nainen'), 
    ('Finn', 'Wolfhard', 'Mies'),
    ('John', 'Travolta', 'Mies'),
    ('Samue L.', 'Jackson', 'Mies'),
    ('Uma', 'Thurman', 'Nainen'),
    ('Harvey', 'Keitel', 'Mies'),
       ('Robert', 'Pattinson', 'Mies'),
    ('Zoë', 'Kravitz', 'Nainen'),
    ('Paul', 'Dano', 'Mies'),
    ('Andy', 'Serkis', 'Mies'),
    ('Colin', 'Farrel', 'Mies'),
    ('Jeffrey', 'Wright', 'Mies'),
    ('Tom','Holland','Mies'),
    ('Tobey','Maguire','Mies'),
    ('Andrew','Garfield','Mies'),
    ('Willem','Dafoe','Mies'),
    ('Alfred','Molina','Mies'),
    ('Jamie', 'Foxx', 'Mies'),
    ('Zendaya', 'Coleman', 'Nainen'),
    ('Jon', 'Favreau', 'Mies'),
    ('Benedict', 'Cumberbatch', 'Mies'),
    ('Marisa', 'Tomei', 'Nainen'),
    ('Daniel', 'Craig', 'Mies'),
    ('Chris','Evans','Mies'),
    ('Ana', 'De Armas', 'Nainen'),
    ('Katherine','Langford','Nainen'),
    ('Joaquin','Phoenix','Mies'),
    ('Robert','De Niro','Mies'),
    ('Zazie','Beetz','Nainen'),
    ('Sondra','James','Nainen');

INSERT INTO nayttelija_rooli (nayttelija_id, elokuva_id, rooli)
  VALUES 
    (1, 1, 'Pennywise'), 
    (2, 1, 'Bill Denbrough'),
    (3, 1, 'Beverly Marsh'), 
    (4, 1, 'Richie Tozier'),
    (5, 2, 'Vincent Vega'),
    (6, 2, 'Jules Winnfield'),
    (7, 2, 'Mie Wallace'),
    (8, 2, 'Winston Wolfe'),
    (9,3, 'Bruce Wayne (Batman)'),
    (10,3, 'Selina Kyle (Catwoman)'),
    (11,3, 'The Riddler'),
    (12,3, 'Alfred'),
    (13,3, 'Oswald Cobblepot (Penguin)'),
    (14,3, 'Lt. James Gordon'),
    (15,4, 'Peter Parker (Spiderman)'),
    (16,4, 'Peter Parker (Spiderman)'),
    (17,4, 'Peter Parker (Spiderman)'),
    (18,4,'Norman Osborn'),
    (19,4,'Dr. Otto Octavius'),
    (20,4,'Max Dillon'),
    (21,4,'Mary Jane'),
    (22,4,'Happy Hogan'),
    (23,4,'Doctor Strange'),
    (24,4, 'May Parker'),
    (25,5, 'Benoit Blanc'),
    (26,5, 'Ransom Drysdale'),
    (27,5, 'Marta Cabrera'),
    (28,5, 'Meg Thrombey'),
    (29,6, 'Joker'),
    (30,6, 'Murray Franklin'),
    (31,6, 'Sophie Dumond'),
    (32,6, 'Dr. Sally');

  INSERT INTO arvostelu(elokuva_id, arvostelija, tahdet, kommentti)
    VALUES 
    (1, 'Saku', 3, 'Hui pelotti ihan viitust'),
    (2, 'Roni', 5, 'Hemmetin hyvä elokuva, suosittelen');
