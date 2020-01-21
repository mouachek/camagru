<?php
require_once "./model/forget_password.php";

function forget_password()
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
        if (doesEmailExist()) {
            send_change_password();
            $messages["ok"] = "A reset password link has been send to your email adress";
            return $messages;
        }
    }
}

$messages = forget_password();
require_once "./view/forget_password.php";
