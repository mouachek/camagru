<?php

require_once "./model/db.php";

function isConnected()
{
    return isset($_SESSION["connected"]) && $_SESSION["connected"] == true;
}

function isFormValid()
{
    if (empty($_POST["email"])) {
        return false;
    }
    return true;
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


function send_change_password()
{
    $from = EMAIL_SENDER;
    $to = $_POST["email"];
    $subject = "Your reset password request";
    $token = generate_token();
    $message = "Reset your password by clicking the link below : " . BASE_URL . "/index.php?page=change_password&token={$token}";
    $headers = "From:" . $from;
    mail($to, $subject, $message, $headers);
}
