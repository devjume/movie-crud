<?php

function lisaaElokuva($nimi, $vuosi, $kesto, $kieli, $ohjaaja, $ikaraja, $genre, $kuva_url, $nayttelijat)
{
  require_once MODULES_DIR."inc/functions.php";
  try {
    
    $db = openDB();

    if (!$db) {
      echo "Database connection Failed!";
    }

    $sqlMovie = "INSERT INTO elokuva (nimi, vuosi, kesto, kieli, ohjaaja_id, ikaraja, genre_id, kuva_url) VALUES (?,?,?,?,?,?,?,?)";

    $pdoStatement = $db->prepare($sqlMovie);


    $nimi = !empty($nimi) ? $nimi : null;
    $vuosi = !empty($vuosi) ? $vuosi : null;
    $kesto = !empty($kesto) ? $kesto : null;
    $kieli = !empty($kieli) ? $kieli : null;
    $ohjaaja_id = !empty($ohjaaja) ? luoOhjaaja($db, $ohjaaja) : null;
    $ikaraja = !empty($ikaraja) ? $ikaraja : null;
    $genre_id = luoGenre($db, $genre);
    $kuva_url = !empty($kuva_url) ? $kuva_url : null;

    $pdoStatement->bindParam(1, $nimi);
    $pdoStatement->bindParam(2, $vuosi);
    $pdoStatement->bindParam(3, $kesto);
    $pdoStatement->bindParam(4, $kieli);
    $pdoStatement->bindParam(5, $ohjaaja_id);
    $pdoStatement->bindParam(6, $ikaraja);
    $pdoStatement->bindParam(7, $genre_id);
    $pdoStatement->bindParam(8, $kuva_url);

    $pdoStatement->execute();

    $elokuvaId = $db->lastInsertId();

    foreach ($nayttelijat as $nayttelija) {
      $nayttelijaId = luoNayttelija($db, $nayttelija);
      luoRooli($db, $nayttelijaId, $elokuvaId, $nayttelija['rooli']);
    }

    return "Elokuva Lisätty";
  } catch (PDOException $e) {
    return $e;
  }
}

function luoNayttelija($db, $nayttelija) {
  // Jos näyttelijän sukupuoli on tyhjä teksti niin muutetaan se NULL arvoksi SQL varten
  if($nayttelija['sukupuoli'] === '') {
    $nayttelija['sukupuoli'] = null;
  }

  $sqlCheckActor = "SELECT id FROM `nayttelija` WHERE `etunimi` = ? AND `sukunimi` = ? AND `sukupuoli` = ?";
  $pdoActorExits = $db->prepare($sqlCheckActor);
  $pdoActorExits->bindParam(1, $nayttelija['etunimi']);
  $pdoActorExits->bindParam(2, $nayttelija['sukunimi']);
  $pdoActorExits->bindParam(3, $nayttelija['sukupuoli']);
  $pdoActorExits->execute();
  $actorId = $pdoActorExits->fetchColumn();

  # Jos näyttelijää ei ole tietokannassa, Sellainen luodaan.
  if (empty($actorId)) {
    $sql = "INSERT INTO nayttelija (etunimi, sukunimi, sukupuoli) VALUES (?,?,?)";
    $pdo = $db->prepare($sql);
    $pdo->bindParam(1, $nayttelija['etunimi']);
    $pdo->bindParam(2, $nayttelija['sukunimi']);
    $pdo->bindParam(3, $nayttelija['sukupuoli']);
    $pdo->execute();
    $newActorId = $db->lastInsertId();
    return $newActorId;
  }

  return $actorId;
}

function luoRooli($db, $nayttelijaId, $elokuvaId, $rooli) {
  $sql = "INSERT INTO nayttelija_rooli (nayttelija_id, elokuva_id, rooli) Values (?,?,?)";
  $pdo = $db->prepare($sql);
  $pdo->bindParam(1, $nayttelijaId);
  $pdo->bindParam(2, $elokuvaId);
  $pdo->bindParam(3, $rooli);
  $pdo->execute();
}

function luoOhjaaja($db, $ohjaaja) {
  $sqlCheckGenre = "SELECT id FROM `ohjaaja` WHERE `nimi` = ?";
  $pdoGenreExits = $db->prepare($sqlCheckGenre);
  $pdoGenreExits->bindParam(1,  $ohjaaja);
  $pdoGenreExits->execute();
  $ohjaaja_id = $pdoGenreExits->fetchColumn();

  # Jos syötettyä ohjaajaa ei ole tietokannassa, Sellainen luodaan.
  if (empty($ohjaaja_id)) {
    $sqlCreateGenre = "INSERT INTO ohjaaja(nimi) VALUES (?)";
    $pdoCreateGenre = $db->prepare($sqlCreateGenre);
    $pdoCreateGenre->bindParam(1, $ohjaaja);
    $pdoCreateGenre->execute();
    $ohjaaja_id = $db->lastInsertId();
    return $ohjaaja_id;
  }
  return $ohjaaja_id;
}

function luoGenre($db, $genre) {
  $sqlCheckGenre = "SELECT id FROM `genre` WHERE `nimi` = ?";
  $pdoGenreExits = $db->prepare($sqlCheckGenre);
  $pdoGenreExits->bindParam(1,  $genre);
  $pdoGenreExits->execute();
  $genre_id = $pdoGenreExits->fetchColumn();

  # Jos syötettyä genreä ei ole tietokannassa, Sellainen luodaan.
  if (empty($genre_id)) {
    $sqlCreateGenre = "INSERT INTO genre(nimi) VALUES (?)";
    $pdoCreateGenre = $db->prepare($sqlCreateGenre);
    $pdoCreateGenre->bindParam(1, $genre);
    $pdoCreateGenre->execute();
    $genre_id = $db->lastInsertId();
    return $genre_id;
  }
  return $genre_id;
}

?>