<?php
session_start();
/*
** controller/create.php          page == create
** controller/login.php           page == login
** controller/logout.php           page == logout
** controller/settings.php           page == settings
*/

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once "./config/database.php";
require_once "./config/config.php";

if (empty($_POST) && empty($_GET)) {
    require_once("./view/index.php");
}

if (isset($_GET["page"]) && $_GET["page"] == "create") {
    require_once "./controller/create.php";
}

if (isset($_GET["page"]) && $_GET["page"] == "login") {
    require_once "./controller/login.php";
}
if (isset($_GET["page"]) && $_GET["page"] == "logout") {
    require_once "./controller/logout.php";
}
if (isset($_GET["page"]) && $_GET["page"] == "settings") {
    require_once "./controller/settings.php";
}
if (isset($_GET["page"]) && $_GET["page"] == "forget_password") {
    require_once "./controller/forget_password.php";
}
if (isset($_GET["page"]) && $_GET["page"] == "change_password") {
    require_once "./controller/change_password.php";
}
if (isset($_GET["page"]) && $_GET["page"] == "confirmation_email") {
    require_once "./controller/confirmation_email.php";
}
if (isset($_GET["page"]) && $_GET["page"] == "camera") {
    require_once "./controller/camera.php";
}
if (isset($_GET["page"]) && $_GET["page"] == "index") {
    require_once "./controller/index_gallery.php";
}
if (isset($_GET["page"]) && $_GET["page"] == "upload") {
    require_once "./controller/upload.php";
}
if (isset($_GET["page"]) && $_GET["page"] == "publish") {
    require_once "./controller/publish.php";
}
