<?php

require_once "./model/db.php";

function isConnected()
{
    return isset($_SESSION["connected"]) && $_SESSION["connected"] == true;
}

function isFormValid()
{
    if (empty($_POST["new_password"])
  || empty($_POST["new_password_confirmation"])) {
        return false;
    }
    return true;
}

 function isTokenValid()
 {
     if (empty($_GET["token"])) {
         return false;
     }
     $key = 'c1am2a3g4r5u';
     $split_token = explode(".", $_GET["token"]);
     $signature = hash_hmac('sha256', "{$split_token[0]}.{$split_token[1]}", $key, true);
     $signature = base64_encode($signature);

     return $signature == $split_token[2];
 }

  function isPasswordSecure()
  {
      define("REGEX_PASSWORD", "#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#");
      $password = $_POST["new_password_confirmation"];
      if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
          return true;
      }
      return false;
  }

  function isPasswordMatching()
  {
      if (isset($_POST['new_password']) && isset($_POST["new_password_confirmation"])
     && $_POST['new_password'] == $_POST["new_password_confirmation"]) {
          return true;
      }

      return false;
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

  function changePassword()
  {
      $payload = getTokenPayload();
      $db = DB::getInstance();
      $req = $db->prepare('SELECT * FROM users WHERE email = :email');
      $req->execute([
          'email' => $payload["email"]
        ]);
      $db_result = $req->fetch();
      $new_password_hash=hash('whirlpool', $_POST["new_password"]);
      $req=$db->prepare('UPDATE users SET password=? WHERE id=?');
      $req->execute(array($new_password_hash,$db_result['id']));
  }
