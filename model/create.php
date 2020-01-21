<?php

require_once "./model/db.php";

function isConnected()
{
    return isset($_SESSION["connected"]) && $_SESSION["connected"] == true;
}

function isFormValid()
{
    if (empty($_POST["username"])
        || empty($_POST["email"])
        || empty($_POST["password"])
        || empty($_POST["password_confirmation"])) {
        return false;
    }
    return true;
}

function isPasswordMatching()
{
    if (isset($_POST['password']) && isset($_POST["password_confirmation"])
        && $_POST['password'] == $_POST["password_confirmation"]) {
        return true;
    }

    return false;
}

function doesEmailExist()
{
    $db = DB::getInstance();
    $stm = $db->prepare("SELECT email FROM users WHERE email = :email_form");
    $stm->execute(['email_form' => $_POST["email"]]);
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
    $stm->execute(['username_form' => $_POST["username"]]);
    $user = $stm->fetch();
    if ($user == false) {
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

function isEmailValid()
{
    define("REGEX_EMAIL", "#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,4}$#");
    $email = $_POST["email"];
    if (preg_match("#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,4}$#", $email)) {
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

function createUser()
{
    $db = DB::getInstance();
    $stm = $db->prepare("INSERT INTO `users` (`username`, `email`, `password`) VALUES (:username, :email, :password)");
    $password = $_POST["password"];
    $password_hach = hash('whirlpool', $password);
    $stm->execute([
        ':username' => $_POST["username"],
        ':email' => $_POST["email"],
        ':password' => $password_hach
    ]);
}

function generate_token()
{
    $key = TOKEN_KEY;
    $header = [
        'typ' => TOKEN_TYPE,
        'alg' => TOKEN_ALG
    ];
    $header = json_encode($header);
    $header = base64_encode($header);
    $payload = [
        'email' => $_POST["email"]
    ];
    $payload = json_encode($payload);
    $payload = base64_encode($payload);
    $signature = hash_hmac(TOKEN_HASH_ALG, "{$header}.{$payload}", $key, true);
    $signature = base64_encode($signature);
    $token = "{$header}.{$payload}.{$signature}";
    return $token;
}

function send_confirm_email()
{
    $from = EMAIL_SENDER;
    $to = $_POST["email"];
    $subject = "Confirm your Camagru account";
    $token = generate_token();
    $message = "Confirm your email by clicking the following link : " . BASE_URL . "/index.php?page=confirmation_email&token={$token}";
    $headers = "From:" . $from;
    mail($to, $subject, $message, $headers);
}
