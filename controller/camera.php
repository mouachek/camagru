<?php

require_once "./model/camera.php";

function camera()
{
    $messages = [];
    if (!isConnected()) {
        header("Location: ./index.php?page=index");
    }
    if (isset($_POST) && isset($_POST["submit_delete"])) {
        Deleteimage();
    }

    $messages["images"] = GetImages();

    return $messages;
}

$messages = camera();
require_once "./view/camera.php";
