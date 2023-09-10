<?php
require($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');
$api_maib = $_POST['maib'];
$stmp_mail = $_POST['smtp'];
$email = $_POST['email'];
$email_password = $_POST['password_email'];
$telegram_api = $_POST['TokenBot'];
$telegram_chatID = $_POST['ChatID'];

$connection = mysqli_connect(servername, user, password, db);
$connection->query("UPDATE `settings` SET `api_maib`='$api_maib',`stmp`='$stmp_mail',`email`='$email',`email_pass`='$email_password',`telegram_api`='$telegram_api',`telegram_chat`= '$telegram_chatID' WHERE `id`='1'");
$connection->close();