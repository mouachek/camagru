<?php

require_once "./model/index_gallery.php";
require_once "./model/comment.php";

function gallery()
{
    $messages = [];

    if (isset($_POST) && isset($_POST["submit_comment"])) {
        if (isFormValid()) {
            addComment();
        }
    }
    if (isset($_POST) && isset($_POST["submit_like"])) {
        like();
    }

    $messages["images"] = GetImages();
    $messages["comments"] = getComments($messages["images"]);
    $messages["pagination"] = getPagination();
    return $messages;
}

$messages = gallery();
require_once "./view/index.php";
