<?php

require_once "./model/db.php";

function isConnected()
{
    return isset($_SESSION["connected"]) && $_SESSION["connected"] == true;
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
