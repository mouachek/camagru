<?php

require_once "./model/db.php";

function isConnected()
{
    return isset($_SESSION["connected"]) && $_SESSION["connected"] == true;
}

function isFormValid()
{
    if (empty($_POST["username"])
  || empty($_POST["password"])) {
        return false;
    }
    return true;
}

function isPasswordSecure()
{
    define("REGEX_PASSWORD", "#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#");
    $password = $_POST["password"];
    if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
        return true;
    }
    return false;
}

function isUsernameValid()
{
    define("REGEX_USERNAME", "/^[a-z\d_]{5,20}$/i");
    $username = $_POST["username"];
    if (preg_match("/^[a-z\d_]{5,20}$/i", $username)) {
        return true;
    }
    return false;
}

function auth()
{
    $db = DB::getInstance();
    $stm = $db->prepare("SELECT username,email,id, email_comment  FROM users WHERE username = :username_form AND password = :hashed_password");
    $stm->execute([
    'username_form' => $_POST["username"],
    'hashed_password' => hash('whirlpool', $_POST["password"])
  ]);
    $user = $stm->fetch();
    return $user;
}

function isValidated()
{
    $db = DB::getInstance();
    $req = $db->prepare("SELECT username,validated FROM users WHERE username = :username");
    $req->execute([
    'username' => $_POST["username"]
  ]);
    $user = $req->fetch();
    if ($user['validated'] == 1) {
        return true;
    }
    return false;
}
