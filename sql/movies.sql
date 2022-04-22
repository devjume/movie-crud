INSERT INTO
  genre(nimi)
VALUES
  ('Kauhu'),
  ('Draama/Rikos'),
  ('Toiminta');
INSERT INTO
  ohjaaja(nimi)
VALUES
  ('Andy Muschietti'),
  ('Quentin Tarantino');

INSERT INTO ohjaaja(nimi) VALUES 
  ('Andy Muschietti'),
  ('Quentin Tarantino');

INSERT INTO elokuva (nimi, vuosi, kesto, kieli, ohjaaja_id, ikaraja, genre_id, kuva_url)
  VALUES('The Batman', 2022, 176, 'Englanti', 1, 16, 1, 'https://m.media-amazon.com/images/M/MV5BZDVkZmI0YzAtNzdjYi00ZjhhLWE1ODEtMWMzMWMzNDA0NmQ4XkEyXkFqcGdeQXVyNzYzODM3Mzg@._V1_.jpg'),
    ('Pulp Fiction', 1993, 154, 'Englanti', 2, 16, 2, 'https://upload.wikimedia.org/wikipedia/en/3/3b/Pulp_Fiction_%281994%29_poster.jpg');

INSERT INTO nayttelija (etunimi, sukunimi, sukupuoli) 
  VALUES 
    ('Bill', 'Skarsgard', 'Mies'), 
    ('Jaeden', 'Martell', 'Mies'), 
    ('Sophia', 'Lillis', 'Nainen'), 
    ('Finn', 'Wolfhard', 'Mies'),
    ('John', 'Travolta', 'Mies'),
    ('Samue L.', 'Jackson', 'Mies'),
    ('Uma', 'Thurman', 'Nainen'),
    ('Harvey', 'Keitel', 'Mies');


INSERT INTO nayttelija_rooli (nayttelija_id, elokuva_id, rooli)
  VALUES 
    (1, 1, 'Pennywise'), 
    (2, 1, 'Bill Denbrough'),
    (3, 1, 'Beverly Marsh'), 
    (4, 1, 'Richie Tozier'),
    (5, 2, 'Vincent Vega'),
    (6, 2, 'Jules Winnfield'),
    (7, 2, 'Mie Wallace'),
    (8, 2, 'Winston Wolfe');

  INSERT INTO arvostelu(elokuva_id, arvostelija, tahdet, kommentti)
    VALUES 
    (1, 'Saku', 3, 'Hui pelotti ihan viitust'),
    (2, 'Roni', 5, 'Hemmetin hyvä elokuva, suosittelen');

    16,
    1,
    'https://m.media-amazon.com/images/M/MV5BZDVkZmI0YzAtNzdjYi00ZjhhLWE1ODEtMWMzMWMzNDA0NmQ4XkEyXkFqcGdeQXVyNzYzODM3Mzg@._V1_.jpg'
  ),
  (
    'Pulp Fiction',
    1993,
    154,
    'Englanti',
    2,
    16,
    2,
    'https://upload.wikimedia.org/wikipedia/en/3/3b/Pulp_Fiction_%281994%29_poster.jpg'
  );
INSERT INTO
  nayttelija (etunimi, sukunimi, sukupuoli)
VALUES
  ('Bill', 'Skarsgard', 'Mies'),
  ('Jaeden', 'Martell', 'Mies'),
  ('Sophia', 'Lillis', 'Nainen'),
  ('Finn', 'Wolfhard', 'Mies'),
  ('John', 'Travolta', 'Mies'),
  ('Samue L.', 'Jackson', 'Mies'),
  ('Uma', 'Thurman', 'Nainen'),
  ('Harvey', 'Keitel', 'Mies');
INSERT INTO
  nayttelija_rooli (nayttelija_id, elokuva_id, rooli)
VALUES
  (1, 1, 'Pennywise'),
  (2, 1, 'Bill Denbrough'),
  (3, 1, 'Beverly Marsh'),
  (4, 1, 'Richie Tozier'),
  (5, 2, 'Vincent Vega'),
  (6, 2, 'Jules Winnfield'),
  (7, 2, 'Mie Wallace'),
  (8, 2, 'Winston Wolfe');
INSERT INTO
  arvostelu(elokuva_id, arvostelija, tahdet, kommentti)
VALUES
  (1, 'Saku', 3, 'Hui pelotti ihan viitust'),
  (
    2,
    'Roni',
    5,
    'Hemmetin hyvä elokuva, suosittelen'
  );