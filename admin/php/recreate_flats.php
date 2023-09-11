<?php
require($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');
$mysql = mysqli_connect(servername, user, password, db);

$title = null;
$description = null;

$jsonUploadedFiles = null;
$id = null;

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
    $description =  $_POST['descr'] ?? '';
    $info = $_POST['info'] ?? '';
    $container = $_POST['container'] ?? '';
    $price = $_POST['price'] ?? '';
    $title = $_POST['title'] ?? '';
    $id = $_POST['id'] ?? '';
    $collection = $_POST['collection'] ?? '';
    $availability = $_POST['availability'] ?? '';

}
if (isset($_FILES['productImage']) && !empty($_FILES['productImage']['name'][0])) {
    $uploadedFiles = $_FILES['productImage'];
} else {
    $uploadedFiles = null;
}

$jsonUploadedFiles = [];
if ($uploadedFiles != null) {
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
        $jsonUploadedFiles = json_encode($jsonUploadedFiles);
    }
}

try {

    if ($id != '') {
        if ($uploadedFiles != null) {
            $mysql->query("UPDATE `products` SET `title`='$title',`collection` = '$collection',`img`='$jsonUploadedFiles',`info`='$info',`descr` = '$description', `price` = '$price', `container` = '$container'  WHERE `id` = '$id'");
            if ($mysql->affected_rows > 0) {
                echo 'Successfully';
            } else {
                echo 'Error';
            }
        } else {
            $mysql->query("UPDATE `products` SET `title`='$title',`name`='$name',`availability`='$availability',`info`='$info',`collection` = '$collection',`descr` = '$description', `price` = '$price', `container` = '$container'  WHERE `id` = '$id'");
            echo 'Successfully';
        }
    }
} catch (exception $e) {
    echo "Error: " . $e->getMessage();
}