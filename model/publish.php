<?php

require_once "./model/db.php";

function isConnected()
{
    return isset($_SESSION["connected"]) && $_SESSION["connected"] == true;
}

function verifData()
{
    return isset($_FILES["data"]);
}

function verifFilter()
{
    return isset($_POST["filter"]) && $_POST["filter"] != "null";
}

function createImage()
{
    $db = DB::getInstance();
    $stm = $db->prepare("INSERT INTO `pictures` (`img_blob`, `user_id`) VALUES (:img_blob, :user_id)");
    $stm->execute([
    ':img_blob' => file_get_contents($_FILES["data"]['tmp_name']),
    ':user_id' => $_SESSION["user"]["id"]
  ]);
}

function transfert()
{
    $ret = is_uploaded_file($_FILES['data']['tmp_name']);
    if (!$ret) {
        return false;
    } else {
        // Traitement de l'image source
        $source = imagecreatefromstring(file_get_contents("./assets/img/" . $_POST["filter"] . ".png"));
        $largeur_source = imagesx($source);
        $hauteur_source = imagesy($source);
        imagealphablending($source, true);
        imagesavealpha($source, true);
        // Traitement de l'image destination
        $destination = imagecreatefromstring(file_get_contents($_FILES['data']['tmp_name']));
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
