<?php
require($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');
$mysql = mysqli_connect(servername, user, password, db);

$productName = null;
$bookingid = null;
$iframeGoogleMaps = null;
$description = null;
$short_desc = null;
$address = null;
$maxHuman = null;
$kvm = null;
$jsonUploadedFiles = null;
$id = null;
$discount = null;
$isValid = true; // Добавляем переменную для проверки валидности
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['productName'] ?? '';
    $bookingid = $_POST['bookingid'] ?? '';
    $iframeGoogleMaps = $_POST['iframe-google-maps'] ?? '';
    $description = $_POST['description'] ?? '';
    $short_desc = $_POST['short_desc'] ?? '';
    $address = $_POST['adress'] ?? '';
    $maxHuman = $_POST['max-human'] ?? '';
    $kvm = $_POST['kvm'] ?? '';
    $id = $_POST['id'] ?? '';
    $discount = $_POST['discount'] ?? '';
    $data_json = $_POST['data_json'] ?? '';
    $closed_dates_str = $_POST['date_closed'] ?? '';
    $closed_dates = explode(',', $closed_dates_str);

    // Удаление лишних пробелов вокруг дат
    $closed_dates = array_map('trim', $closed_dates);

    // Удаление пустых элементов
    $closed_dates = array_filter($closed_dates);

    // Преобразование дат в нужный формат
    $formattedDates = array_map(function ($item) {
        return date('Y-m-d', strtotime($item));
    }, $closed_dates);

    // Преобразование в JSON
    $jsonClosedDates = json_encode($formattedDates);
}
if(isset($_FILES['productImage']) && !empty($_FILES['productImage']['name'][0])) {
    $uploadedFiles = $_FILES['productImage'];
}
else{
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

    $arr = [
        "bookingid" => $bookingid,
        "description" => $description,
        "kvm" => $kvm,
        "short_desc" => $short_desc
    ];
    $arr = json_encode($arr, JSON_UNESCAPED_UNICODE);
    $sql1 = $mysql->query("SELECT `img` FROM `flats` WHERE `id` = '$id'")->fetch_array();
    $imgarray = json_decode($sql1['img']);
    $imgarray1 = json_encode($imgarray);
    $imgJsonString = '';
    $sql = $mysql->query("SELECT `img` FROM `flats` WHERE `id` = '49'");
    if ($sql->num_rows > 0) {
        while ($row = $sql->fetch_assoc()) {
            $imgJsonString = $row["img"];
        }
    }
    if ($id != '') {
        if ($uploadedFiles != null) {
            $mysql->query("UPDATE `flats` SET `title`='$productName',`adress`='$address',`max_adults`='$maxHuman',`GoogleMap`='$iframeGoogleMaps',`img`='$jsonUploadedFiles',`info`='$arr', `discount`='$discount',`price_dates`='$data_json', `close_dates` = '$jsonClosedDates'  WHERE `id` = '$id'");
            if ($mysql->affected_rows > 0) {
                echo 'Successfully';
            } else {
                echo 'Error';
            }
        } else {
            $mysql->query("UPDATE `flats` SET `title`='$productName',`adress`='$address',`max_adults`='$maxHuman',`GoogleMap`='$iframeGoogleMaps',`img`='$imgJsonString',`info`='$arr', `discount`='$discount',`price_dates`='$data_json', `close_dates` = '$jsonClosedDates'  WHERE `id` = '$id'");
            echo 'Successfully';
        }
    }
} catch (exception $e) {
    echo "Error: " . $e->getMessage();
}
