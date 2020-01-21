<?php

require_once "./model/db.php";

function isConnected()
{
    return isset($_SESSION["connected"]) && $_SESSION["connected"] == true;
}

function isAlreadyValidated()
{
    $payload = getTokenPayload();
    $db = DB::getInstance();
    $req = $db->prepare("SELECT email,validated FROM users WHERE email = :email");
    $req->execute([
    'email' => $payload["email"]
  ]);
    $user = $req->fetch();
    if ($user['validated'] == 1) {
        return true;
    }
    return false;
}

function isTokenValid()
{
    if (empty($_GET["token"])) {
        return false;
    }
    $key = TOKEN_KEY;
    $split_token = explode(".", $_GET["token"]);
    $signature = hash_hmac(TOKEN_HASH_ALG, "{$split_token[0]}.{$split_token[1]}", $key, true);
    $signature = base64_encode($signature);

    return $signature == $split_token[2];
}

 function getTokenPayload()
 {
     if (empty($_GET["token"])) {
         return false;
     }
     $split_token = explode(".", $_GET["token"]);
     $payload = base64_decode($split_token[1]);
     $payload = json_decode($payload, true);
     return $payload;
 }

 function confirmation_email_check()
 {
     $payload = getTokenPayload();
     $db = DB::getInstance();
     $req = $db->prepare('SELECT * FROM users WHERE email = :email');
     $req->execute([
         'email' => $payload["email"]
       ]);
     $db_result = $req->fetch();
     $req=$db->prepare('UPDATE users SET validated = 1 WHERE id=?');
     $req->execute(array($db_result['id']));
 }
