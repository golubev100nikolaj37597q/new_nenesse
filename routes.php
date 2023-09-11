<?php
// Получаем запрошенный URL
$request_uri = $_SERVER['REQUEST_URI'];

// Определите здесь свои роуты
$routes = [
    // Регулярное выражение для соответствия URL "collections/product/{collections}/{id}"
    '~^/collections/([^/]+)/products/([^/]+)$~' => 'collections/handle_product.php',
    '~^/collections/([^?]+)(?:\?(.*))?$~' => 'collections/handle_collection.php',

    // Другие роуты
];

// Проверяем, соответствует ли запрошенный URL какому-либо роуту
foreach ($routes as $pattern => $handler) {
    if (preg_match($pattern, $request_uri, $matches)) {
        // Извлекаем значения collections и id из URL
        $collectionsWithPrefix = $matches[1];
        if (isset($matches[2])) {
            $id = $matches[2];
        }
        
        // Используем функцию basename() для извлечения последней части URL (без префикса)
        $collections = basename($collectionsWithPrefix);
        
        // Вызываем обработчик с передачей извлеченных значений
        include $handler;
        exit;
    }
    
}

// Если роут не найден, можно вывести сообщение об ошибке 404
http_response_code(404);
echo 'Страница не найдена';
?>
