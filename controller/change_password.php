<?php
require_once "./model/change_password.php";

function change_password()
{
    $messages = [];

    if (isConnected()) {
        header("Location: ./index.php?page=index");
        return;
    }

    if (isset($_POST) && isset($_POST["submit"])) {
        if (!isFormValid()) {
            $messages["incomplete_form"] = "The form is not complete";
            return $messages;
        }
        if (!isTokenValid()) {
            $messages["invalid_token"] = "Your token is invalid";
            return $messages;
        }
        if (!isPasswordSecure()) {
            $messages["password_not_secure"] = "your password must contain at least one uppercase, lowercase, special characters and more than 8 characters length";
            return $messages;
        }
        if (!isPasswordMatching()) {
            $messages["password_not_matching"] = "The password and its confirmation doesn't match";
            return $messages;
        }
        changePassword();
        $messages["ok"] = "Password changed";
        return $messages;
    }
}

$messages = change_password();
require_once "./view/change_password.php";
