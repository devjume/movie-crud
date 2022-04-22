-- PULP FICTION

INSERT INTO `arvostelut` (`elokuva_id`, `arvostelija`, `tahdet`, `kommentti`) VALUES
(3, 'Veeti', 5, 'Olipa kyllä plottwistejä joo ja tanssii ku John Travolta :D');

INSERT INTO `elokuva` (`elokuva_id`, `nimi`, `vuosi`, `kesto`, `kieli`, `ohjaaja_id`, `ikaraja`) VALUES
(3, );


INSERT INTO `nayttelija` (`nayttelija_id`, `nayttelija_enimi`, `nayttelija_snimi`, `nayttelija_sex`) VALUES
(9, 'John', 'Travolta', 'M'),
(10, 'Uma', 'Thurman', 'N'),
(11, 'Samuel L', 'Jackson', 'M'),
(12, 'Bruce', 'Willis', 'M');

INSERT INTO `nayttelija_rooli` (`elokuva_id`, `rooli`) VALUES
(3, 'Vincent Vega'),
(3, 'Mia Wallace'),
(3, 'Jules Winnfield'),
(3, 'Butch Coolidge');

INSERT INTO `ohjaaja` (`ohjaaja_enimi`, `ohjaaja_snimi`) VALUES
('Quentin', 'Tarantino');

-- AMOS AND ANDREW

INSERT INTO `arvostelut` (`elokuva_id`, `arvostelija`, `tahdet`, `kommentti`) VALUES
(5, 'Joona', 2, 'Eipä oikee mistään kotosin');

INSERT INTO `elokuvat` (`elokuva_id`, `elokuva_nimi`, `elokuva_tulovuosi`, `elokuva_kesto`, `elokuva_kieli`, `ohjaaja_id`, `ikaraja`) VALUES
(5, 'Pulp Fiction', 1993, 154, 'Englanti', 3, 16);

INSERT INTO `elokuva_genret` (`elokuva_id`, `gen_id`) VALUES
(3, 5);

INSERT INTO `genret` (`gen_nimi`) VALUES
('Draama/rikos');

INSERT INTO `nayttelija` (`nayttelija_id`, `nayttelija_enimi`, `nayttelija_snimi`, `nayttelija_sex`) VALUES
(7, 'Nicolas', 'Cage', 'M'),
(11, 'Samuel L', 'Jackson', 'M'),
(16, 'Michael', 'Lerner', 'M'),
(17, 'Margaret', 'Colin', 'N');

INSERT INTO `nayttelijat` (`nayttelija_id`, `elokuva_id`, `rooli`) VALUES
(17, 3, 'Amos Odell'),
(18, 3, 'Andrew Sterling'),
(19, 3, 'Jules Winnfield'),
(20, 3, 'Butch Coolidge');

INSERT INTO `ohjaaja` (`ohjaaja_id`, `ohjaaja_enimi`, `ohjaaja_snimi`) VALUES

-- kaks muuta elokuvaa 

INSERT INTO
  `arvostelut` (
    `elokuva_id`,
    `arvostelija`,
    `tahdet`,
    `kommentti`
  )
VALUES
  (2, 'Roni', 5, 'Hemmetin hyvä elokuva, suosittelen!!');
INSERT INTO
  `elokuvat` (
    `elokuva_id`,
    `elokuva_nimi`,
    `elokuva_tulovuosi`,
    `elokuva_kesto`,
    `elokuva_kieli`,
    `ohjaaja_id`,
    `ikaraja`
  )VALUES
  (2, '
Spider-Man: Into the Spider-Verse', 2018, 117, 'Englanti', 2, 7);
INSERT INTO
  `elokuva_genret` (`elokuva_id`, `gen_id`)
VALUES
  (2, 2);
INSERT INTO
  `genret` (`gen_id`, `gen_nimi`)
VALUES
  (2, 'animaatio');
INSERT INTO
  `nayttelija` (
    `nayttelija_id`,
    `nayttelija_enimi`,
    `nayttelija_snimi`,
    `nayttelija_sex`
  )
VALUES
  (5, 'Shameik', 'Moore', 'M'),
  (6, 'Jake', 'Johnson', 'M'),
  (7, 'Nicolas', 'Cage', 'M'),
  (8, 'Mahershala', 'Ali', 'M');
INSERT INTO
  `nayttelijat` (`nayttelija_id`, `elokuva_id`, `rooli`)
VALUES
  (5, 2, 'Miles Morales'),
  (6, 2, 'Peter B. Parker'),
  (7, 2, 'Spider-Man Noir'),
  (8, 2, 'Uncle Aaron');
INSERT INTO
  `ohjaaja` (`ohjaaja_id`, `ohjaaja_enimi`, `ohjaaja_snimi`)
VALUES
  (2, 'Bob', 'Persichetti');
--
INSERT INTO
  `arvostelut` (
    `elokuva_id`,
    `arvostelija`,
    `tahdet`,
    `kommentti`
  )
VALUES
  (4, 'Roni', 4, 'Ei mitään hajuu en oo kattonu, mutt näyttää iha ok.');
INSERT INTO
  `elokuvat` (
    `elokuva_id`,
    `elokuva_nimi`,
    `elokuva_tulovuosi`,
    `elokuva_kesto`,
    `elokuva_kieli`,
    `ohjaaja_id`,
    `ikaraja`
  )VALUES
  (4, 'Kick-Ass', 2010, 117, 'Englanti', 4, 16);
INSERT INTO
  `elokuva_genret` (`elokuva_id`, `gen_id`)
VALUES
  (4, 4);
INSERT INTO
  `genret` (`gen_id`, `gen_nimi`)
VALUES
  (4, 'Toiminta');
INSERT INTO
  `nayttelija` (
    `nayttelija_id`,
    `nayttelija_enimi`,
    `nayttelija_snimi`,
    `nayttelija_sex`
  )
VALUES
  (13, 'Aaron', 'Taylor-Johnson', 'M'),
  (14, 'Evan', 'Peters', 'M'),
  (7, 'Nicolas', 'Cage', 'M'),
  (15, 'Deborah', 'Twiss', 'N');
INSERT INTO
  `nayttelijat` (`nayttelija_id`, `elokuva_id`, `rooli`)
VALUES
  (13, 2, 'Kick-Ass'),
  (14, 2, 'Todd'),
  (7, 2, 'Big Daddy'),
  (15, 2, 'Mrs. Zane');
INSERT INTO
  `ohjaaja` (`ohjaaja_id`, `ohjaaja_enimi`, `ohjaaja_snimi`)
VALUES
  (4, 'Matthew', 'Matthew Vaughn	');


SELECT elokuva.nimi,elokuva.vuosi, elokuva.kesto,elokuva.kieli, elokuva.ikaraja, ohjaaja.nimi AS 'Ohjaaja', genre.nimi AS 'Genre', elokuva.posterilinkki 
FROM elokuva
INNER JOIN ohjaaja ON elokuva.ohjaaja_id = ohjaaja.id 
INNER JOIN genre ON elokuva.genre_id = genre.id;