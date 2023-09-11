<?php
require($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');
$mysql = mysqli_connect(servername, user, password, db);
function get_info_product($id): array
{
  global $mysql;
  $sql = $mysql->query("SELECT * FROM `products` WHERE `id` = '$id'")->fetch_array();



  return [
    'id' => $sql['id'],
    'title' => $sql['title'],
    'name' => $sql['name'],
    'price' => $sql['price'],
    'descr' => $sql['descr'],
    'img' => $sql['img'],
    'info' => $sql['info'],
    'container' => $sql['container'],
    'collection' => $sql['collection'],
    'availability' => $sql['availability'],
    'views' => $sql['views']
  ];
}
function get_info_product_by_name($name): array
{
  global $mysql;
  $sql = $mysql->query("SELECT * FROM `products` WHERE `name` = '$name'")->fetch_array();
  if ($sql) {
    return [
      'id' => $sql['id'],
      'name' => $sql['name'],
      'title' => $sql['title'],
      'price' => $sql['price'],
      'descr' => $sql['descr'],
      'img' => $sql['img'],
      'info' => $sql['info'],
      'container' => $sql['container'],
      'collection' => $sql['collection'],
      'availability' => $sql['availability'],
      'views' => $sql['views']
    ];
  } else {
    return [];
  }
}
//Сделай функцию который возвращает все обьекты с collection = $collection
function get_products_by_collection($collection, $availability = null, $gte = null, $lte = null)
{
  global $mysql;

  $collection = $mysql->real_escape_string($collection);

  // Инициализируем параметры для подготовленного запроса
  $params = array();

  // Создаем начальную часть SQL-запроса
  $query = "SELECT * FROM `products` WHERE `collection` = ?";
  $paramsTypes = "s";
  $params[] = &$collection; // Добавляем $collection в массив параметров

  if ($availability !== null) {
    $query .= " AND `availability` = ?";
    $paramsTypes .= "s";
    $params[] = &$availability;
  }

  if ($gte !== null && $lte !== null) {
    $query .= " AND `price` BETWEEN ? AND ?";
    $paramsTypes .= "dd";
    $params[] = &$gte;
    $params[] = &$lte;
  }

  // Подготавливаем запрос с динамическим числом параметров
  $stmt = $mysql->prepare($query);

  if (!$stmt) {
    die("Ошибка подготовки запроса: " . $mysql->error);
  }

  // Динамически связываем параметры
  $bindParams = array_merge(array($paramsTypes), $params);
  call_user_func_array(array($stmt, 'bind_param'), $bindParams);

  $stmt->execute();

  $result = $stmt->get_result();

  $products = array();

  while ($row = $result->fetch_assoc()) {
    $products[] = $row;
  }

  $stmt->close();

  return $products;
}
function get_max_price_by_collection($collection)
{
  global $mysql;
  $collection = $mysql->real_escape_string($collection);

  $query = "SELECT MAX(price) AS max_price FROM `products` WHERE `collection` = '$collection'";
  $result = $mysql->query($query);

  if (!$result) {
    die("Ошибка выполнения запроса: " . $mysql->error);
  }

  $row = $result->fetch_assoc();

  $maxPrice = $row['max_price'];

  return $maxPrice;
}
function get_availability_counts_by_collection($collection)
{
  global $mysql;
  $collection = $mysql->real_escape_string($collection);

  // Запрос для получения количества объектов с availability = 1
  $query1 = "SELECT COUNT(*) AS count1 FROM `products` WHERE `collection` = '$collection' AND `availability` = 1";

  // Запрос для получения количества объектов с availability = 0
  $query2 = "SELECT COUNT(*) AS count2 FROM `products` WHERE `collection` = '$collection' AND `availability` = 0";

  // Общий запрос для получения общего количества объектов
  $queryTotal = "SELECT COUNT(*) AS total FROM `products` WHERE `collection` = '$collection'";

  $result1 = $mysql->query($query1);
  $result2 = $mysql->query($query2);
  $resultTotal = $mysql->query($queryTotal);

  if (!$result1 || !$result2 || !$resultTotal) {
    die("Ошибка выполнения запроса: " . $mysql->error);
  }

  $row1 = $result1->fetch_assoc();
  $row2 = $result2->fetch_assoc();
  $rowTotal = $resultTotal->fetch_assoc();

  $count1 = $row1['count1'];
  $count2 = $row2['count2'];
  $total = $rowTotal['total'];

  return [
    'count1' => $count1,
    'count2' => $count2,
    'total' => $total,
  ];
}
function get_src_photo($name)
{
  global $mysql;

  $name = $mysql->real_escape_string($name); // Защита от SQL-инъекций

  // SQL-запрос для получения img по имени товара
  $query = "SELECT `img` FROM `products` WHERE `name` = '$name'";

  $result = $mysql->query($query);

  if (!$result) {
    die("Ошибка выполнения запроса: " . $mysql->error);
  }

  $row = $result->fetch_assoc();
  $img = null;
  if ($row && isset($row['img'])) {
    $img =  $row['img'];
  }

  // Распарсить JSON-строку в массив
  $data = json_decode($img, true);

  if ($data) {
    $photoPaths = array(); // Создать массив для хранения путей к фотографиям

    foreach ($data as $item) {
      if (isset($item['file_path'])) {
        $photoPaths[] = $item['file_path']; // Добавить путь к фотографии в массив
      }
    }

    // Вывести массив с путями к фотографиям
    return $photoPaths;
  } else {
    echo "Ошибка при распарсивании JSON-строки.";
  }
}
function add_views($name)
{
  global $mysql;

  $name = $mysql->real_escape_string($name); // Защита от SQL-инъекций

  // SQL-запрос для увеличения значения views
  $query = "UPDATE `products` SET `views` = `views` + 1 WHERE `name` = '$name'";

  $result = $mysql->query($query);

  return "Succeflly";
}
function getShuffledTopViewsProducts($collection = null)
{
  global $mysql;

  // SQL-запрос для получения 5 самых просматриваемых товаров
  $query = "SELECT * FROM `products`";

  if ($collection) {
    $collection = $mysql->real_escape_string($collection);
    $query .= " WHERE `collection` = '$collection'";
  }

  $query .= " ORDER BY `views` DESC LIMIT 5";

  $result = $mysql->query($query);

  if (!$result) {
    die("Ошибка выполнения запроса: " . $mysql->error);
  }

  $products = array();

  while ($row = $result->fetch_assoc()) {
    $products[] = $row;
  }

  // Перемешать массив товаров
  shuffle($products);

  return $products;
}
