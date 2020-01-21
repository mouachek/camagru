<?php
require_once "./model/create.php";

function create()
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
        if (!isPasswordMatching()) {
            $messages["password_not_matching"] = "The password and its confirmation do not match.";
            return $messages;
        }
        if (!isPasswordSecure()) {
            $messages["password_not_secure"] = "Your password must contain at least one uppercase, lowercase, special characters and has more than 8 characters length";
            return $messages;
        }
        if (!isEmailValid()) {
            $messages["email_not_valid"] = "Please enter a correct email address.";
            return $messages;
        }
        if (!isUsernameValid()) {
            $messages["username_not_valid"] = "The username can contain only letters, digit, underscore and at least 5 characters.";
            return $messages;
        }
        if (doesEmailExist()) {
            $messages["email_exist"] = "An account already exists with this Email";
            return $messages;
        }
        if (doesUsernameExist()) {
            $messages["username_exist"] = "An account already exists with this Username";
            return $messages;
        }

        if (createUser()) ;
        {
            send_confirm_email();
            $messages["ok"] = "Your account has been created, you will receive a comfirmation email";
            return $messages;
        }
    }
}

$messages = create();
require_once "./view/create.php";
