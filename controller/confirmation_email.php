<?php
require_once "./model/confirmation_email.php";

function confirmation_email()
{
    $messages = [];

    if (isConnected()) {
        header("Location: ./index.php?page=index");
        return;
    }
    if (!isTokenValid()) {
        $messages["invalid_token"] = "Your token is invalid";
        return $messages;
    }
    if (isAlreadyValidated()) {
        $messages["account_already_validated"] = "Your account is already validated !";
        return $messages;
    }
    confirmation_email_check();
    $messages["ok"] = "Account validated";
    return $messages;
}

$messages = confirmation_email();
require_once "./view/confirmation_email.php";
