<?php
require($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

function get_info_product($id): array
{
  $mysql = mysqli_connect(servername, user, password, db);
  $sql = $mysql->query("SELECT * FROM `products` WHERE `id` = '$id'")->fetch_array();

  $data = json_decode($sql['info'], true);

  return ['id' => $sql['id'], 'title' => $sql['title'], 'price' => $sql['price'], 'descr' => $sql['descr'], 'img' => $data['img'], 'info' => $data['info']];
}
