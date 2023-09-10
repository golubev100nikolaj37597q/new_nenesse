<?php


require($_SERVER['DOCUMENT_ROOT'].'/php/config.php');

$mysql = mysqli_connect(servername, user, password, db);
$id =$_GET['id'];
$mysql->query("DELETE FROM `forms` WHERE id = $id");
Header('Location: /index.php');