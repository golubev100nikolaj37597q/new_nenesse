<?php

require($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$connection = mysqli_connect(servername, user, password, db);
$connection->query("UPDATE `admins` SET `password` = '$password' WHERE `id`= 1");
$connection->close();
