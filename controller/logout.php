<?php
require_once "./model/logout.php";

function logout()
{
    disconnect();
}

logout();
header("Location: ./index.php?page=index");
