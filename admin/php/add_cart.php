<?php
session_start();

// Получить значение из $_POST['name']
if (isset($_POST['cart'])) {
    echo $_POST['cart'];
    $itemName = $_POST['cart'];

    // Проверить, существует ли уже массив $_SESSION['cart']
    if (!isset($_SESSION['cart'])) {
        // Если нет, создать пустой массив
        $_SESSION['cart'] = array();
    }

    // Добавить полученное значение в массив $_SESSION['cart']
    $_SESSION['cart'][] = $itemName;

    // Сохранить изменения в сессии
    session_write_close();
    
}