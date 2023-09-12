<?php

session_start();

// Функция для удаления последнего элемента с заданным значением из $_SESSION['cart']
function removeFromCart($itemName) {
    if (isset($_SESSION['cart'])) {
        // Ищем последний ключ элемента с заданным значением
        $key = array_search($itemName, array_reverse($_SESSION['cart'], true), true);
        
        // Если элемент с заданным значением найден, удаляем его
        if ($key !== false) {
            unset($_SESSION['cart'][$key]);
        }
    }
}
function removeAllFromCart($itemName) {
    if (isset($_SESSION['cart'])) {
        // Используем array_filter для удаления всех вхождений элемента
        $_SESSION['cart'] = array_filter($_SESSION['cart'], function($value) use ($itemName) {
            return $value !== $itemName;
        });
    }
}
if (isset($_POST['cart'])) {
    $itemName = $_POST['cart'];

    if(isset($_POST['type'])){
        $type = $_POST['type'];
        if($type == 'all'){
            removeAllFromCart($itemName);
            session_write_close();
            echo "Success";
            return;
        }
        if($type == 'single'){
            removeFromCart($itemName);
            session_write_close();
            echo "Success";
            return;
        }
    }
    session_write_close();
    echo "Success";
}
