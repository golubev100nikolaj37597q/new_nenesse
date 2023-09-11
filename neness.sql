-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 11 2023 г., 23:14
-- Версия сервера: 8.0.30
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `neness`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `login` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$vPVTXQHDRWamSCm9ocLG1u4Vq6hiNXV/ibrKuPFHOxom9DY5/SMHW', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `descr` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `container` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `collection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `availability` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `title`, `price`, `descr`, `info`, `container`, `img`, `collection`, `availability`, `views`) VALUES
(2, 'sfgdgdg', '42342344234', 25, '4234242342', '<p>23434</p>', '43434', '[{\"file_path\":\"/assets/product-img/64ff5e0930f59.jpg\"},{\"file_path\":\"/assets/product-img/64ff5e09311ca.jpg\"}]', '365days-dufte', '1', 6),
(3, '1', 'dfsfsdf', 45, 'fsdf', '<p>fsdfsdfd</p>', '189/10', '[{\"file_path\":\"/assets/product-img/64ff1462683ad.png\"}]', '365days-dufte', '1', 100),
(4, '2', 'sfdsdgsg', 45, 'fsdfsdf', '<p>gsdfgfs</p>', '189/10', '[{\"file_path\":\"/assets/product-img/64ff1462683ad.png\"}]', 'proben', '1', 101),
(5, '414', '4', 3123, '423423', '<p>423423</p>', '3123', '[{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3a1c7ad.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3a1c8cf.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3a1cb29.jpg\"}]', 'fur-ihn', '0', 11),
(6, '414', '4', 3123, '423423', '<p>423423</p>', '3123', '[{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3cc7c42.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3cc7d15.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3cc7daf.jpg\"}]', 'fur-ihn', '0', 11),
(7, '414', '4', 3123, '423423', '<p>423423</p>', '3123', '[{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3e052a8.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3e053cd.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3e054af.jpg\"}]', 'fur-ihn', '0', 11),
(8, '414', '4', 3123, '423423', '<p>423423</p>', '3123', '[{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3e6d6fe.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3e6d7e3.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3e6d8d1.jpg\"}]', 'fur-ihn', '0', 11),
(9, '414', '4', 3123, '423423', '<p>423423</p>', '3123', '[{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3e94a3c.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3e94bc0.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3e94d01.jpg\"}]', 'fur-ihn', '0', 11),
(10, '414', '4', 3123, '423423', '<p>423423</p>', '3123', '[{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3eb8bd1.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3eb8cc9.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3eb8db2.jpg\"}]', 'fur-ihn', '0', 11),
(11, '414', '4', 3123, '423423', '<p>423423</p>', '3123', '[{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3edc775.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3edc834.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3edc8e1.jpg\"}]', 'fur-ihn', '0', 11),
(12, '414', '4', 3123, '423423', '<p>423423</p>', '3123', '[{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3f0c525.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3f0c5f4.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3f0c6b7.jpg\"}]', 'fur-ihn', '0', 11),
(13, '414', '4', 3123, '423423', '<p>423423</p>', '3123', '[{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3f27cae.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3f27d98.png\"},{\"file_path\":\"\\/assets\\/product-img\\/64ff6a3f27e41.jpg\"}]', 'fur-ihn', '0', 11);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
