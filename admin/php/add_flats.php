<?php
require($_SERVER['DOCUMENT_ROOT'].'/php/config.php');
function isPositiveInteger($value) : bool {
  return is_numeric($value) && intval($value) > 0;
}
function isNotEmpty($value) : bool {
  return isset($value) && trim($value) !== '';
}
$isValid = true;
$productName = null;
$description = null;
$jsonUploadedFiles = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $description = $_POST['description'] ?? '';
  $short_desc = $_POST['short_desc'] ?? '';

  $jsonClosedDates = json_encode($formattedDates);
  if (!isNotEmpty($productName)) {
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

        
        $uploadDirectory = $_SERVER['DOCUMENT_ROOT']. '/assets/product-img/';

        
        if (!file_exists($uploadDirectory)) {
          mkdir($uploadDirectory, 0777, true);
        }

        
        $uploadPath = $uploadDirectory . $newFileName;
        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
          
          $uploadedFileInfo = array(
            'file_path' => str_replace($_SERVER['DOCUMENT_ROOT'],"",$uploadPath)
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


  $arr = [
      "bookingid" => $bookingid,
      "description" => $description,
      "kvm" => $kvm,
      "short_desc" => $short_desc
];
$arr = json_encode($arr);
$stmt = $mysql->prepare("INSERT INTO `flats`(`title`, `img`, `info`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssdssssss", $productName, $jsonUploadedFiles, $arr);

if ($stmt->execute()) {
    echo "Successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
}