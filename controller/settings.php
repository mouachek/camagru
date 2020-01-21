<?php
require_once "./model/settings.php";

function settings()
{
    $messages = [];

    if (!isConnected()) {
        header("Location: ./index.php?page=index");
        return;
    }

    if (isset($_POST) && isset($_POST["submit_comment_email"])) {
        if (!checkCommentEmail()) {
            $messages["wrong_email_comment"] = "You must select either Yes or No";
            return $messages;
        }

        changeCommentEmail();
        $messages["ok_email_comment"] = "Your email preference has been updated";
        return $messages;
    }

    if (isset($_POST) && isset($_POST["submit_username"])) {
        if (username_Same_Old()) {
            $messages["same_username"] = "You have enter the same username";
            return $messages;
        }

        if (doesUsernameExist()) {
            $messages["username_exist"] = "An account already exists with this Username";
            return $messages;
        }

        if (!isUsernameValid()) {
            $messages["username_not_valid"] = "The username can contain only letters, digit, underscore and at least 5 characters";
            return $messages;
        }

        change_Username();
        $messages["ok_username"] = "username changed";
        return $messages;
    }

    if (isset($_POST) && isset($_POST["submit_email"])) {
        if (email_Same_Old()) {
            $messages["same_email"] = "You have enter the same email";
            return $messages;
        }

        if (!isEmailValid()) {
            $messages["email_not_valid"] = "the syntax of the email entered is not correct";
            return $messages;
        }

        if (doesEmailExist()) {
            $messages["email_exist"] = "An account already exists with this Email";
            return $messages;
        }

        change_email();
        $messages["ok_email"] = "email changed";
        return $messages;
    }

    if (isset($_POST) && isset($_POST["submit_password"])) {
        if (!isFormValidPassword()) {
            $messages["incomplete_form"] = "The form is not complete";
            return $messages;
        }
        if (!isPasswordMatching()) {
            $messages["password_not_matching"] = "The new password and its confirmation doesn't match";
            return $messages;
        }
        if (!isPasswordSecure()) {
            $messages["password_not_secure"] = "your password must contain at least one uppercase, lowercase, special characters and more than 8 characters length";
            return $messages;
        }
        if (!password_Not_Old()) {
            $messages["password_not_old"] = "It's not your old password";
            return $messages;
        }
        change_Password();
        $messages["ok_password"] = "password changed";
        return $messages;
    }
}

$messages = settings();
require_once "./view/settings.php";
