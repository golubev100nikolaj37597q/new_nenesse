<?php
require($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');
function isPositiveInteger($value): bool
{
  return is_numeric($value) && intval($value) > 0;
}
function isNotEmpty($value): bool
{
  return isset($value) && trim($value) !== '';
}
$isValid = true;
$title = null;
$description = null;
$price = null;
$container = null;
$jsonUploadedFiles = null;
$info = null;
$collection = null;
$availability = null;
$name = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'] ?? '';
  $description = $_POST['descr'] ?? '';
  $info = $_POST['info'] ?? '';
  $reviews_data = $_POST['reviews_data'] ?? '';
  $container = $_POST['container'] ?? '';
  $price = $_POST['price'] ?? '';
  $title = $_POST['title'] ?? '';
  $id = $_POST['id'] ?? '';
  $collection = $_POST['collection'] ?? '';
  $availability = $_POST['availability'] ?? '';

  if (!isNotEmpty($title)) {
    $isValid = false;
  }
  if (!isNotEmpty($description)) {
    $isValid = false;
  }

  $uploadedFiles = $_FILES['productImage'] ?? null;
  $jsonUploadedFiles = [];

  if ($uploadedFiles && is_array($uploadedFiles['name'])) {
    $fileCount = count($uploadedFiles['name']);
    for ($i = 0; $i < $fileCount; $i++) {
      if ($uploadedFiles['error'][$i] === UPLOAD_ERR_OK) {

        $fileTmpPath = $uploadedFiles['tmp_name'][$i];
        $fileName = $uploadedFiles['name'][$i];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));


        $newFileName = uniqid() . '.' . $fileExtension;


        $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/assets/product-img/';


        if (!file_exists($uploadDirectory)) {
          mkdir($uploadDirectory, 0777, true);
        }


        $uploadPath = $uploadDirectory . $newFileName;
        if (move_uploaded_file($fileTmpPath, $uploadPath)) {

          $uploadedFileInfo = array(
            'file_path' => str_replace($_SERVER['DOCUMENT_ROOT'], "", $uploadPath)
          );
          $jsonUploadedFiles[] = $uploadedFileInfo;
        } else {
          $isValid = false; // Произошла ошибка при перемещении файла
        }
      } else {
        $isValid = false; // Произошла ошибка при загрузке файла
      }
    }
  }


  $jsonUploadedFiles = json_encode($jsonUploadedFiles);
}

if ($isValid) {

  $mysql = mysqli_connect(servername, user, password, db);

  $stmt = $mysql->prepare("INSERT INTO `products`(`title`,`price`,`container`, `img`, `info`, `descr`,`name`,`availability`,`reviews`,`collection`) VALUES (?, ?, ?, ?, ?, ?,?,?,?,?)");
  $stmt->bind_param("sissssssss", $title, $price, $container, $jsonUploadedFiles, $info, $description, $name, $availability, $reviews_data, $collection);

  if ($stmt->execute()) {
    echo "Successfully";
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
}
