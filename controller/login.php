<?php
require_once "./model/login.php";

function login()
{
    $messages = [];

    if (isConnected()) {
        header("Location: ./index.php?page=index");
        return;
    }

    if (isset($_POST) && isset($_POST["submit"])) {
        if (!isFormValid()) {
            $messages["incomplete_form"] = "The form is not complete.";
            return $messages;
        }
        if (!isPasswordSecure()) {
            $messages["password_not_secure"] = "Your password must contain at least one uppercase, lowercase, special characters and has more than 8 characters length";
            return $messages;
        }
        if (!isUsernameValid()) {
            $messages["username_not_valid"] = "The username can contain only letters, digit, underscore and at least 5 characters.";
            return $messages;
        }

        $result = auth();
        if ($result == false) {
            $messages["wrong_login"] = "The username and password do not match.";
            return $messages;
        }

        if (isValidated()) {
            $_SESSION["connected"] = true;
            $_SESSION["user"] = $result;
            header("Location: ./index.php?page=index");
        } else {
            $messages["account_not_validated"] = "Account not validated";
            return $messages;
        }
    }
}

$messages = login();
require_once "./view/login.php";
