<?php

require_once "./model/db.php";

function isConnected()
{
    return isset($_SESSION["connected"]) && $_SESSION["connected"] == true;
}

function isImageTypeValid()
{
    if ($_FILES['fic']['type'] == "image/jpeg"
    || $_FILES['fic']['type'] == "image/jpg"
  || $_FILES['fic']['type'] == "image/png") {
        return true;
    }
    return false;
}

function GetImages()
{
    $db = DB::getInstance();
    $req = $db->prepare("SELECT img_blob,id FROM pictures WHERE user_id = :user_id");
    $req->execute([
      'user_id' => $_SESSION["user"]["id"]
    ]);
    $donnees = $req->fetchAll(PDO::FETCH_ASSOC);
    $res = [];
    foreach ($donnees as $row) {
        array_push($res, [
     'id' => $row['id'],
     'img_blob' => base64_encode($row['img_blob'])
    ]);
    }
    return $res;
}

function Deleteimage()
{
    $db = DB::getInstance();
    $stm = $db->prepare("DELETE FROM `pictures` WHERE user_id = :user_id AND id = :id");
    $stm->execute([
      ':user_id' => $_SESSION["user"]["id"],
      ':id' => $_POST["img_id"]
    ]);
}

function isFilterSelected()
{
    return isset($_POST["radio"]) && !empty($_POST["radio"]);
}

function transfert()
{
    $img_blob   = '';
    $ret        = is_uploaded_file($_FILES['fic']['tmp_name']);
    if (!$ret) {
        return false;
    } else {
        // Traitement de l'image source
        $source = imagecreatefromstring(file_get_contents("./assets/img/" . $_POST["radio"] . ".png"));
        $largeur_source = imagesx($source);
        $hauteur_source = imagesy($source);
        imagealphablending($source, true);
        imagesavealpha($source, true);
        // Traitement de l'image destination
        $destination = imagecreatefromstring(file_get_contents($_FILES['fic']['tmp_name']));
        $largeur_destination = imagesx($destination);
        $hauteur_destination = imagesy($destination);
        // Calcul des coordonnées pour placer l'image source dans l'image de destination
        $destination_x = ($largeur_destination - $largeur_source)/2;
        $destination_y =  ($hauteur_destination - $hauteur_source)/2;
        // On place l'image source dans l'image de destination
        imagecopy($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source);

        ob_start();
        imagepng($destination);
        $img_blob = ob_get_contents(); // read from buffer
        ob_end_clean(); // delete buffer
        $db = DB::getInstance();
        $stm = $db->prepare("INSERT INTO `pictures` (`img_blob`, `user_id`) VALUES (:img_blob, :user_id)");
        $stm->execute([
          ':img_blob' => $img_blob,
            ':user_id' => $_SESSION["user"]["id"]
           ]);

        return true;
    }
}
