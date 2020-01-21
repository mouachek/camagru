<?php

require_once "./model/db.php";

function isConnected()
{
    return isset($_SESSION["connected"]) && $_SESSION["connected"] == true;
}

function isFormValidPassword()
{
    if (empty($_POST["current_password"])
  || empty($_POST["new_password"])
  || empty($_POST["new_password_confirmation"])) {
        return false;
    }
    return true;
}

 function isPasswordMatching()
 {
     if (isset($_POST['new_password']) && isset($_POST["new_password_confirmation"])
    && $_POST['new_password'] == $_POST["new_password_confirmation"]) {
         return true;
     }
     return false;
 }

 function isPasswordSecure()
 {
     define("REGEX_PASSWORD", "#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#");
     $password = $_POST["new_password"];
     if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
         return true;
     }
     return false;
 }

 function isEmailValid()
 {
     define("REGEX_EMAIL", "#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,4}$#");
     $email = $_POST["new_email"];
     if (preg_match("#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,4}$#", $email)) {
         return true;
     }
     return false;
 }

 function isUsernameValid()
 {
     define("REGEX_USERNAME", "/^[a-z\d_]{5,20}$/i");
     $username = $_POST["new_username"];
     if (preg_match("/^[a-z\d_]{5,20}$/i", $username)) {
         return true;
     }
     return false;
 }

 function password_Not_Old()
 {
     $db = DB::getInstance();
     $req = $db->prepare('SELECT * FROM users WHERE username = :username');
     $req->execute([
     'username' => $_SESSION["user"]["username"]
   ]);
     $db_result = $req->fetch();
     if (($db_result["password"] === hash('whirlpool', $_POST["current_password"]))) {
         return true;
     }
     return false;
 }

 function email_Same_Old()
 {
     $db = DB::getInstance();
     $req = $db->prepare('SELECT * FROM users WHERE username = :username');
     $req->execute([
     'username' => $_SESSION["user"]["username"]
   ]);
     $db_result = $req->fetch();
     if (($db_result["email"] === ($_POST["new_email"]))) {
         return true;
     }
     return false;
 }

function username_Same_Old()
{
    $db = DB::getInstance();
    $req = $db->prepare('SELECT * FROM users WHERE username = :username');
    $req->execute([
    'username' => $_SESSION["user"]["username"]
  ]);
    $db_result = $req->fetch();
    if (($db_result["username"] === ($_POST["new_username"]))) {
        return true;
    }
    return false;
}

function doesEmailExist()
{
    $db = DB::getInstance();
    $stm = $db->prepare("SELECT email FROM users WHERE email = :email_form");
    $stm->execute(['email_form' => $_POST["new_email"]]);
    $user = $stm->fetch();
    if ($user == false) {
        return false;
    }
    return true;
}

function doesUsernameExist()
{
    $db = DB::getInstance();
    $stm = $db->prepare("SELECT username FROM users WHERE username = :username_form");
    $stm->execute(['username_form' => $_POST["new_username"]]);
    $user = $stm->fetch();
    if ($user == false) {
        return false;
    }
    return true;
}

function change_Username()
{
    $db = DB::getInstance();
    $req = $db->prepare('SELECT * FROM users WHERE username = :username');
    $req->execute([
        'username' => $_SESSION["user"]["username"]
      ]);
    $db_result = $req->fetch();
    $new_username= $_POST["new_username"];
    $req=$db->prepare('UPDATE users SET username=? WHERE id=?');
    $req->execute(array($new_username,$db_result['id']));
    $_SESSION["user"]["username"] = $_POST["new_username"];
}

function change_Email()
{
    $db = DB::getInstance();
    $req = $db->prepare('SELECT * FROM users WHERE username = :username');
    $req->execute([
        'username' => $_SESSION["user"]["username"]
      ]);
    $db_result = $req->fetch();
    $new_email= $_POST["new_email"];
    $req=$db->prepare('UPDATE users SET email=? WHERE id=?');
    $req->execute(array($new_email,$db_result['id']));
    $_SESSION["user"]["email"] = $_POST["new_email"];
}

function change_Password()
{
    $db = DB::getInstance();
    $password_hash= hash('whirlpool', $_POST["current_password"]);
    $req = $db->prepare('SELECT * FROM users WHERE username = :username');
    $req->execute([
        'username' => $_SESSION["user"]["username"]
      ]);
    $db_result = $req->fetch();
    $new_password_hash=hash('whirlpool', $_POST["new_password"]);
    $req=$db->prepare('UPDATE users SET password=? WHERE id=?');
    $req->execute(array($new_password_hash,$db_result['id']));
}

function checkCommentEmail() {
    return isset($_POST) && isset($_POST["state"]) && ($_POST["state"] == '0' || $_POST["state"] == '1');
}

function changeCommentEmail() {
    $db = DB::getInstance();
    $req = $db->prepare('UPDATE users SET email_comment = :state WHERE id=:user_id');
    $req->execute([
        'user_id' => $_SESSION["user"]["id"],
        'state' => $_POST["state"]
      ]);

    $_SESSION["user"]["email_comment"] = $_POST["state"];
}
