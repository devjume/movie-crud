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