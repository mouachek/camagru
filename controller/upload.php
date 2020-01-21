<?php

require_once "./model/upload.php";

function send_image()
{
    $messages = [];

    if (!isConnected()) {
        header("Location: ./index.php?page=index");
        return;
    }

    if (isset($_POST) && isset($_POST["submit_delete"])) {
        Deleteimage();
    }

    if (isset($_POST) && isset($_POST["submit"])) {
        if (!isFilterSelected()) {
            $messages["not_filter_selected"] = "You have to select a filter";
        } else {
            if (isset($_FILES['fic'])) {
                if (!isImageTypeValid()) {
                    $messages["bad_type"] = "You have to upload only png or jpeg images";
                } else {
                    if (!transfert()) {
                        $messages["unknown"] = "The image upload failed, please try again later.";
                    }
                }
            }
        }
    }
    $messages["images"] = GetImages();

    return $messages;
}
$messages = send_image();
require_once "./view/upload.php";
