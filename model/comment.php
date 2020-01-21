<?php

function isFormValid()
{
    if (empty($_POST["comment"])) {
        return false;
    }
    return true;
}

function addComment()
{
    $db = DB::getInstance();
    $stm = $db->prepare("INSERT INTO `comments` (`user_id`, `picture_id`, `comment`) VALUES (:user_id, :picture_id, :comment)");
    $stm->execute([
      ':user_id' => $_SESSION["user"]["id"],
      ':picture_id' => $_POST["img_id"],
      ':comment' => htmlentities($_POST["comment"], ENT_QUOTES, 'UTF-8')
    ]);


    $author = getPictureAuthor($_POST["img_id"]);

    if ($author["email_comment"] == 1) {
        send_comment_email($author);
    }
}

function getPictureAuthor($picture_id)
{
    $db = DB::getInstance();
    $req = $db->prepare('SELECT pictures.id, users.* FROM pictures, users WHERE pictures.id = :picture_id AND pictures.user_id = users.id');
    $req->execute([
        'picture_id' => $picture_id
    ]);

    $author = $req->fetch();

    return $author;
}

function getComments($images)
{
    $img_ids = [];

    foreach ($images as $image) {
        array_push($img_ids, $image["id"]);
    }

    $db = DB::getInstance();
    $in_values = implode(',', $img_ids);
    $req = $db->prepare("SELECT comments.user_id,comments.picture_id,comments.comment,users.username,users.id FROM comments,users WHERE picture_id IN (".$in_values.") AND users.id = comments.user_id");
    $req->execute();
    $comments = $req->fetchAll(PDO::FETCH_ASSOC);
    return $comments;
}

function send_comment_email($author)
{
    $from = EMAIL_SENDER;
    $to = $author["email"];
    $subject = "Someone commented your picture";
    $token = generate_token($author["email"]);
    $message = "Hello " . $author["username"] . ", you recently received the following comment for one of your pictures: </br></br>" . $_POST["comment"];
    $headers = "From:" . $from;
    mail($to, $subject, $message, $headers);
}

function generate_token($email)
{
    $key = TOKEN_KEY;
    $header = [
        'typ' => TOKEN_TYPE,
        'alg' => TOKEN_ALG
    ];
    $header = json_encode($header);
    $header = base64_encode($header);
    $payload = [
        'email' => $email
    ];
    $payload = json_encode($payload);
    $payload = base64_encode($payload);
    $signature = hash_hmac(TOKEN_HASH_ALG, "{$header}.{$payload}", $key, true);
    $signature = base64_encode($signature);
    $token = "{$header}.{$payload}.{$signature}";
    return $token;
}
