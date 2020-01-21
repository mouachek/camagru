<?php
require_once("./model/db.php");

function configDatabase()
{
  $db = DB::getInstance();
  $query = $db->prepare("SHOW DATABASES LIKE 'camagru';");
  $query->execute();
  $query->setFetchMode(PDO::FETCH_ASSOC);
  $res = $query->fetch();
  $query->closeCursor();
  if (!empty($res))
  {
  	$db->query("USE camagru;");
  	return (0);
  }
  $query = $db->prepare("
  SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
  SET AUTOCOMMIT = 0;
  START TRANSACTION;
  SET time_zone = '+00:00';

  CREATE DATABASE IF NOT EXISTS camagru;
  USE camagru;

  CREATE TABLE `comments` (
    `id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `picture_id` int(11) NOT NULL,
    `comment` text NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  CREATE TABLE `likes` (
    `id` int(11) NOT NULL,
    `img_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  CREATE TABLE `pictures` (
    `id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `img_blob` longblob NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  CREATE TABLE `users` (
    `id` int(11) NOT NULL,
    `username` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` text NOT NULL,
    `validated` int(11) NOT NULL DEFAULT '0',
    `email_comment` tinyint(4) NOT NULL DEFAULT '1'
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `comments`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `likes`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `pictures`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `comments`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;
  ");
  $query->execute();
}

?>
