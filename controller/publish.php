<?php

require_once "./model/publish.php";

function publish()
{
    if (!isConnected()) {
        header("Location: ./index.php?page=index");
        return;
    }
    $messages = [];
    if (isset($_POST) && isset($_POST["submit_upload"])) {
        if (!verifData()) {
            $messages["no_image"] = "You submitted no content.";
            return $messages;
        }

        if (!verifFilter()) {
            $messages["no_filter"] = "You have to select a filter.";
            return $messages;
        }

        if (!transfert()) {
            $messages["unknown"] = "The image upload failed, please try again later.";
        }
    }

    return $messages;
}

$messages = publish();

echo json_encode($messages);
