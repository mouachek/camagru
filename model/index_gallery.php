<?php

require_once("./model/db.php");
require_once("./config/setup.php");

function isConnected()
{
    return isset($_SESSION["connected"]) && $_SESSION["connected"] == true;
}

function getCurrentPageNumber($totalPages)
{
    if (isset($_GET['cur_page']) && !empty($_GET['cur_page']) && $_GET['cur_page'] > 0 && $_GET['cur_page'] <= $totalPages) {
        $_GET['cur_page'] = intval($_GET['cur_page']);
        $currentPage = $_GET['cur_page'];
    } else {
        $currentPage = 1;
    }
    return $currentPage;
}

function GetImages()
{
    $db = DB::getInstance();
    $imagesPerPage = 9;
    $totalImagesReq = $db->query('SELECT id FROM pictures');
    $totalImages = $totalImagesReq->rowCount();
    $totalPages = ceil($totalImages / $imagesPerPage);
    $currentPage = getCurrentPageNumber($totalPages);
    $start = ($currentPage - 1) * $imagesPerPage;
    $req = $db->query("SELECT pictures.* ,count(DISTINCT(likes.id)) AS likes FROM pictures LEFT JOIN likes ON pictures.id = likes.img_id WHERE pictures.id GROUP BY pictures.id
      ORDER BY id DESC LIMIT " . $start . " , " . $imagesPerPage);
    $req->execute();
    $donnees = $req->fetchAll(PDO::FETCH_ASSOC);
    $res = [];
    foreach ($donnees as $row) {
        array_push($res, [
            'id' => $row['id'],
            'likes' => $row['likes'],
            'img_blob' => base64_encode($row['img_blob']),
        ]);
    }
    return $res;
}

function Like()
{
    $db = DB::getInstance();
    $req = $db->prepare("SELECT user_id,img_id FROM likes WHERE user_id = :user_id AND img_id = :img_id");
    $req->execute([
        ':user_id' => $_SESSION['user']['id'],
        ':img_id' => $_POST["img_id"],
    ]);
    $result = $req->fetch();
    if ($result == 0) {
        $stm = $db->prepare("INSERT INTO `likes` (`user_id`, `img_id`) VALUES (:user_id, :img_id)");
        $stm->execute([
            ':img_id' => $_POST["img_id"],
            ':user_id' => $_SESSION['user']['id']
        ]);
    }
}

function getLikes()
{
    $db = DB::getInstance();
    $stmt = $db->prepare("SELECT count(*) FROM likes WHERE img_id = :img_id");
    $stmt->execute([
        ':img_id' => $_POST["img_id"],
    ]);
    $count = $stmt->fetchColumn();
    return $count;
}

function getPagination()
{
    $db = DB::getInstance();
    $imagesPerPage = 9;
    $totalImagesReq = $db->query('SELECT id FROM pictures');
    $totalImages = $totalImagesReq->rowCount();
    $totalPages = ceil($totalImages / $imagesPerPage);
    return [
        'total_page' => $totalPages,
        'current_page' => getCurrentPageNumber($totalPages)
    ];
}
