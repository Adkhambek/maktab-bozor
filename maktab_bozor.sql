-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 16, 2020 at 08:18 AM
-- Server version: 5.7.21-20-beget-5.7.21-20-1-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `heaven8_mbozor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--
-- Creation: Sep 07, 2020 at 09:36 AM
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--
-- Creation: Sep 07, 2020 at 10:29 AM
-- Last update: Sep 23, 2020 at 05:26 PM
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `uz` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `uz`, `ru`) VALUES
(49, '📓 Daftarlar', '📓 Блокноты'),
(50, '📃 Qog’ozlar', '📃 Бумаги'),
(51, '🖊 Ruchkalar', '🖊 Ручки'),
(52, '✏️ Qalamlar', '✏️ Карандаши'),
(53, '✂️ Qaychilar', '✂️ Ножницы'),
(54, '📐 Lineykalar', '📐 Линейки'),
(67, 'Qalamdonlar', 'Пеналы'),
(68, 'Ochqichlar', 'Точилки'),
(69, 'O\'chirg\'ichlar', 'Ластики'),
(70, '📝 Chizish uchun', '📝 Для рисования'),
(71, '🖍 Belgilagichlar', '🖍 Фломастеры'),
(72, 'Yelimlar', 'Клеи'),
(73, 'Sirkullar', 'Круги'),
(74, 'Kalkulyatorlar', 'Калькуляторы'),
(75, 'Muqovalar', 'Обложки'),
(76, '📒 Bloknotlar', '📒 Блокноты'),
(77, '📜 Albomlar', '📜 Альбомы'),
(78, 'Boshqalar', 'Другие');

-- --------------------------------------------------------

--
-- Table structure for table `orderproduct`
--
-- Creation: Sep 05, 2020 at 07:01 AM
-- Last update: Sep 23, 2020 at 05:28 PM
--

DROP TABLE IF EXISTS `orderproduct`;
CREATE TABLE `orderproduct` (
  `id` int(11) NOT NULL,
  `chat_id` int(20) NOT NULL,
  `username` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `latitude` varchar(200) NOT NULL,
  `longitude` varchar(200) NOT NULL,
  `product` longtext NOT NULL,
  `overallprice` varchar(50) NOT NULL,
  `date` varchar(20) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderproduct`
--

INSERT INTO `orderproduct` (`id`, `chat_id`, `username`, `name`, `tel`, `latitude`, `longitude`, `product`, `overallprice`, `date`, `status`) VALUES
(11, 456613303, 'Heaven_8', 'Adham', '998998471943', '41,466481', '69,362165', '<li>A4 qog\'oz, 14 ta  - 84 000 so\'m</li>', '84000', '08.09.2020,13:29', 1),
(12, 560729430, 'softproger', 'Adham', '998998000334', '41,466231', '69,361967', '<li>Qalam, 18 ta  - 16 200 so\'m</li>', '16200', '07.09.2020,15:58', 1),
(13, 516468111, 'umarov_as', 'Azam', '998998711621', '41,291048', '69,281109', '<li>A3 qog\'oz, 20 ta  - 160 000 so\'m</li><li>A4 qog\'oz, 18 ta  - 108 000 so\'m</li><li>A3 qog\'oz, 3 ta  - 27 000 so\'m</li>', '295000', '07.09.2020,16:50', 1),
(14, 1238388622, 'askmaktabbozor', 'aza', '+998981173000', '41,291048', '69,281109', '<li>Бумага A3, 10 ta  - 90 000 so\'m</li>', '90000', '07.09.2020,20:41', 1),
(15, 564091431, '', 'Владик', '998977806767', '41,376068', '69,207379', '<li>Бумага A3, 22 ta  - 198 000 so\'m</li>', '198000', '08.09.2020,22:34', 1),
(16, 14349913, 'oxgroup', 'Иип', '00999888', '41,321849', '69,213046', '<li>Qalam, 1 ta  - 900 so\'m</li>', '900', '18.09.2020,21:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--
-- Creation: Aug 29, 2020 at 08:03 AM
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `uz` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `categoryId` varchar(255) DEFAULT NULL,
  `price` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `photoUrl` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `uz`, `ru`, `categoryId`, `price`, `photoUrl`) VALUES
(149, 'A3 qog\'oz', 'Бумага A3', '50', '9000', 'empty-img.png'),
(150, 'A4 qog\'oz', 'Бумага A4', '50', '6000', 'empty-img.png'),
(151, 'Qalam', 'Qalam ru', '52', '900', 'maktabbozor-logo1.png'),
(152, 'Ruchka', 'Ruchka ru', '51', '400', 'Habits.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--
-- Creation: Sep 07, 2020 at 07:57 AM
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `chat_id` int(30) NOT NULL,
  `username` varchar(300) NOT NULL,
  `first_name` varchar(300) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `chat_id`, `username`, `first_name`, `date`) VALUES
(1, 456613303, 'Heaven_8', 'Adham', '07.09.2020,13:09'),
(2, 560729430, 'softproger', '.', '07.09.2020,13:10'),
(3, 516468111, 'umarov_as', 'Azam', '07.09.2020,16:49'),
(4, 1238388622, 'askmaktabbozor', 'Ask', '07.09.2020,20:40'),
(5, 902118503, '', 'Baxrom', '07.09.2020,23:42'),
(6, 276289970, 'harris_a', 'Adam', '08.09.2020,13:36'),
(7, 564091431, '', 'Собир', '08.09.2020,22:32'),
(8, 156109685, 'Rash1d117', '♠️♠️♠️', '08.09.2020,22:33'),
(9, 44730777, '', 'Umid', '10.09.2020,17:55'),
(10, 348466028, 'timabtc', 'Tim', '11.09.2020,10:53'),
(11, 588056073, '', '?????', '11.09.2020,10:54'),
(12, 380416481, 'mirazizxooja', 'Mirazizxo\'ja Ne\'matov', '12.09.2020,16:15'),
(13, 14349913, 'oxgroup', 'Aziz', '18.09.2020,21:25'),
(14, 985672864, '', '《☆☆Jo\'rabek ☆☆》', '19.09.2020,22:54');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--
-- Creation: Aug 31, 2020 at 07:21 AM
--

DROP TABLE IF EXISTS `shoppingcart`;
CREATE TABLE `shoppingcart` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `optionNum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shoppingcart`
--

INSERT INTO `shoppingcart` (`id`, `userId`, `productId`, `quantity`, `optionNum`) VALUES
(154, 836645255, 150, '3', 6000),
(172, 456613303, 150, '14', 6000),
(173, 1238388622, 150, '3', 6000);

-- --------------------------------------------------------

--
-- Table structure for table `texts`
--
-- Creation: Aug 28, 2020 at 12:39 PM
-- Last update: Sep 23, 2020 at 04:47 PM
--

DROP TABLE IF EXISTS `texts`;
CREATE TABLE `texts` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `uz` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `ru` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `texts`
--

INSERT INTO `texts` (`id`, `keyword`, `uz`, `ru`) VALUES
(1, 'main_page_btn_1', '📁 Menyu', '📁 Меню'),
(2, 'main_page_btn_2', '🛒 Savatcha', '🛒 Корзина'),
(3, 'main_page_btn_3', '🛵 Yetkazib berish', '🛵 Доставка'),
(4, 'main_page_btn_4', '📩 Bog\'lanish', '📩 Контакт'),
(5, 'main_page_btn_5', '🇺🇿🔄🇷🇺 Tilni almashtirish', '🇺🇿🔄🇷🇺 Изменить язык'),
(6, 'page_main_text', 'Bosh saxifa', 'Главная страница'),
(7, 'contact_page', 'O\'zingizni qiziqtirgan savollaringizni quyidagi manzilga yuboring: ', 'Присылайте ваши вопросы через:'),
(8, 'delivery_info', 'Yetkazib berish xizmati Toshket shahri bóylab 1km gacha 4000min so\'m, 1 km dan keyin xar km 1.000sumda so\'mdan narxlanadi.', 'Доставка по городу Ташкента первые 1 км 4000 сум. После 1 км каждый км по 1000 сум.'),
(9, 'back_btn', '↪️ Orqaga', '↪️ Назад'),
(10, 'page_category', 'Menyuni tanlang', 'Выберите меню'),
(11, 'page_no_category', 'Hozircha kategoriyalar yo\'q.', 'Категории пока нет.'),
(12, 'shopping_btn', '🛒 Savatga', '🛒 На корзину'),
(13, 'page_no_product  ', 'Bu kategoriyada mahsulotlar yo\'q ', 'В этой категории нет продуктов'),
(14, 'page_choose_count_text', 'Iltimos, mahsulot miqdorini tanlang:', 'Пожалуйста, выберите количество продукта:'),
(15, 'product_added_to_cart', 'Mahsulot savatga qo\'shildi.', 'Продукт был добавлен в корзину.'),
(16, 'page_products_text', 'Tovarni tanlang', 'Выберите товар'),
(17, 'show_all', 'Barchasi', 'Показать все товары'),
(18, 'soum', 'so\'m', 'сум'),
(19, 'adding_more', '➕ yana qo\'shish', '➕ Добавить еще'),
(20, 'go_home', '🏠 Bosh saxifa', '🏠 Главная страница'),
(21, 'pieces', 'dona', 'штук'),
(22, 'order_count', '💵 Buyurtmani hisoblash', '💵 Подсчет заказа'),
(23, 'checkout', '🛎 Buyurtma berish', '🛎 Оформить заказ'),
(24, 'change', '⚙️ O\'zgartirish', '⚙️ Изменить'),
(25, 'clear', '❌ Tozalash', '❌ Очистить'),
(26, 'cart_is_empty', 'Savat bo’sh holatda', 'Корзина пуста'),
(27, 'your_order', 'Sizning buyurtmangiz:', 'Ваш заказ:'),
(28, 'overall', 'Jami:', 'Итого:'),
(29, 'pickup', '🚶 Olib ketish', '🚶 Самовывоз'),
(30, 'delivery', '🚗 Yetkazib berish', '🚗 Доставка'),
(31, 'cant_send_location', '✅ Lokatsiya yubora olmayamman', '✅ Не могу отправить локацию'),
(32, 'do_order', '✅ Buyurtma berish', '✅ Заказать'),
(33, 'cancel', '❌ Bekor qilish', '❌ Отменить'),
(34, 'our_phone_number', 'Bizning telefon raqamimiz:', 'Наш номер телефона:'),
(35, 'choose_delivery_type', 'Xarid turini tanlang:', 'Выберите способ доставки:'),
(36, 'cart_is_cleared', 'Savat tozalandi.', 'Корзина очищена.'),
(37, 'send_contact', '📲 Kontaktni yuborish', '📲 Отправить контакт'),
(38, 'send_your_phone_number', 'Iltimos, kontaktingizni yuboring yoki telefon raqamingizni 901234567 ko\'rinishida yuboring.', 'Пожалуйста, отправьте ваш контакт или введите номер телефона в формате 901234567.'),
(39, 'send_location', '🗺 Geolokatsiyani yuborish', '🗺 Отправить локацию'),
(40, 'send_your_location', 'Iltimos, lokatsiyangizni yuboring. (GPS ni yoqishni unutmang)', 'Пожалуйста, отправьте вашу локацию. (Не забудьте включить геоданные GPS)'),
(41, 'pickupType', 'Olib ketish', 'Самовывоз'),
(42, 'deliveryType', 'Yetkazib berish', 'Доставка'),
(43, 'enter_your_name', 'Iltimos, ismingizni kiriting:', 'Пожалуйста, введите Ваше имя:'),
(44, 'close_window', 'Oynani yopish', 'Закрыть окно'),
(45, 'press_x_to_clear', 'Mahsulotni savatdan o\'chirish uchun ❌ ni bosing.', 'Нажмите ❌ для удаления продукта из корзины'),
(46, 'order_confirmed', 'Rahmat. Sizning buyurtmangiz qabul qilindi. Tez orada sizga operatorimiz buyurtmani tasdiqlash uchun qo\'ng\'iroq qiladi.', 'Спасибо. Ваш заказ принят. Сейчас Вам перезвонит оператор'),
(47, 'num_input', 'Katta son kiritish', 'Katta son kiritish ru'),
(48, 'name', 'Ism:', 'Имя:'),
(49, 'phone_number', 'Telefon raqam:', 'Номер телефона:'),
(50, 'order', '<b>BUYURTMA:</b>', '<b>ЗАКАЗ:</b>'),
(51, 'order_canceled', 'Buyurtma bekor qilindi.', 'Заказ отменен.'),
(52, 'location_error', '⚠️ Iltimos lokatsiyani kiriting', '⚠️ пожалуйста, введите местоположение'),
(53, 'sleep_check', 'Afsuski, hozirgi vaqtda barcha operatorlar dam olishmoqda. Buyurtmani ertalab qabul qilib olamiz. Rahmat ️☺️ ', 'К сожалению, в данное время все операторы отдыхают. Приним ваш заказ утром. Спасибо ☺️');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Sep 07, 2020 at 07:53 AM
-- Last update: Oct 13, 2020 at 06:12 PM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `data_json` longtext NOT NULL,
  `chatID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `data_json`, `chatID`) VALUES
(31, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\",\"categoryId\":\"Njg=\",\"productId\":\"MTUw\",\"productOption\":\"NjAwMA==\",\"orderType\":\"ZGVsaXZlcnlUeXBl\",\"firstName\":\"QWRoYW0=\",\"latitude\":\"NDEsNDY2NDgx\",\"longitude\":\"NjksMzYyMTY1\",\"phoneNumber\":\"OTk4OTk4NDcxOTQz\",\"orderText\":\"PGI+WUVUS0FaSUIgQkVSSVNIPC9iPgrinpbinpbinpbinpbinpbinpbinpbinpbinpbinpYKCjxiPkJVWVVSVE1BOjwvYj4K8J+UuCBBNCBxb2cnb3ogLCAxNCBkb25hIC0gPGk+ODQgMDAwIHNvJ208L2k+CgrinpbinpbinpbinpbinpbinpbinpbinpbinpbinpbinpbinpbinpYKPGI+SmFtaTo8L2I+IDxpPjg0IDAwMCBzbydtPC9pPgoKPGI+SXNtOjwvYj4gQWRoYW0KPGI+VGVsZWZvbiByYXFhbTo8L2I+IDk5ODk5ODQ3MTk0Mw==\"}', 456613303),
(32, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\",\"categoryId\":\"NTI=\",\"productId\":\"MTUx\",\"productOption\":\"OTAw\",\"orderType\":\"ZGVsaXZlcnlUeXBl\",\"firstName\":\"QWRoYW0=\",\"latitude\":\"NDEsNDY2MjMx\",\"longitude\":\"NjksMzYxOTY3\",\"phoneNumber\":\"OTk4OTk4MDAwMzM0\",\"orderText\":\"PGI+WUVUS0FaSUIgQkVSSVNIPC9iPgrinpbinpbinpbinpbinpbinpbinpbinpbinpbinpYKCjxiPkJVWVVSVE1BOjwvYj4K8J+UuCBRYWxhbSAsIDE4IGRvbmEgLSA8aT4xNiAyMDAgc28nbTwvaT4KCuKeluKeluKeluKeluKeluKeluKeluKeluKeluKeluKeluKeluKelgo8Yj5KYW1pOjwvYj4gPGk+MTYgMjAwIHNvJ208L2k+Cgo8Yj5Jc206PC9iPiBBZGhhbQo8Yj5UZWxlZm9uIHJhcWFtOjwvYj4gOTk4OTk4MDAwMzM0\"}', 560729430),
(33, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\"}', 0),
(34, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\",\"categoryId\":\"NTA=\",\"productId\":\"MTQ5\",\"productOption\":\"OTAwMA==\",\"orderType\":\"ZGVsaXZlcnlUeXBl\",\"firstName\":\"QXphbQ==\",\"latitude\":\"NDEsMjkxMDQ4\",\"longitude\":\"NjksMjgxMTA5\",\"phoneNumber\":\"OTk4OTk4NzExNjIx\",\"orderText\":\"PGI+WUVUS0FaSUIgQkVSSVNIPC9iPgrinpbinpbinpbinpbinpbinpbinpbinpbinpbinpYKCjxiPkJVWVVSVE1BOjwvYj4K8J+UuCBBMyBxb2cnb3ogLCAyMCBkb25hIC0gPGk+MTYwIDAwMCBzbydtPC9pPgoK8J+UuCBBNCBxb2cnb3ogLCAxOCBkb25hIC0gPGk+MTA4IDAwMCBzbydtPC9pPgoK8J+UuCBBMyBxb2cnb3ogLCAzIGRvbmEgLSA8aT4yNyAwMDAgc28nbTwvaT4KCuKeluKeluKeluKeluKeluKeluKeluKeluKeluKeluKeluKeluKelgo8Yj5KYW1pOjwvYj4gPGk+Mjk1IDAwMCBzbydtPC9pPgoKPGI+SXNtOjwvYj4gQXphbQo8Yj5UZWxlZm9uIHJhcWFtOjwvYj4gOTk4OTk4NzExNjIx\"}', 516468111),
(35, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\"}', 44995481),
(36, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\",\"categoryId\":\"Nzc=\",\"productId\":\"MTQ5\",\"productOption\":\"NjAwMA==\",\"orderType\":\"ZGVsaXZlcnlUeXBl\",\"firstName\":\"YXph\",\"latitude\":\"NDEsMjkxMDQ4\",\"longitude\":\"NjksMjgxMTA5\",\"phoneNumber\":\"Kzk5ODk4MTE3MzAwMA==\",\"orderText\":\"PGI+0JTQvtGB0YLQsNCy0LrQsDwvYj4K4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6WCgo8Yj7Ql9CQ0JrQkNCXOjwvYj4K8J+UuCDQkdGD0LzQsNCz0LAgQTMgLCAxMCDRiNGC0YPQuiAtIDxpPjkwIDAwMCDRgdGD0Lw8L2k+CgrinpbinpbinpbinpbinpbinpbinpbinpbinpbinpbinpbinpbinpYKPGI+0JjRgtC+0LPQvjo8L2I+IDxpPjkwIDAwMCDRgdGD0Lw8L2k+Cgo8Yj7QmNC80Y86PC9iPiBBCjxiPtCd0L7QvNC10YAg0YLQtdC70LXRhNC+0L3QsDo8L2I+ICs5OTg5ODExNzMwMDA=\"}', 1238388622),
(37, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\",\"categoryId\":\"NDk=\",\"productId\":\"MTQ5\",\"productOption\":\"OTAw\"}', 902118503),
(38, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"NTE=\"}', 276289970),
(39, '{\"lang\":\"cnU=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"NTA=\",\"productId\":\"MTQ5\",\"productOption\":\"OTAwMA==\",\"orderType\":\"ZGVsaXZlcnlUeXBl\",\"firstName\":\"0JLQu9Cw0LTQuNC6\",\"latitude\":\"NDEsMzc2MDY4\",\"longitude\":\"NjksMjA3Mzc5\",\"phoneNumber\":\"OTk4OTc3ODA2NzY3\",\"orderText\":\"PGI+0JTQvtGB0YLQsNCy0LrQsDwvYj4K4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6WCgo8Yj7Ql9CQ0JrQkNCXOjwvYj4K8J+UuCDQkdGD0LzQsNCz0LAgQTMgLCAyMiDRiNGC0YPQuiAtIDxpPjE5OCAwMDAg0YHRg9C8PC9pPgoK4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6WCjxiPtCY0YLQvtCz0L46PC9iPiA8aT4xOTggMDAwINGB0YPQvDwvaT4KCjxiPtCY0LzRjzo8L2I+INCS0LvQsNC00LjQugo8Yj7QndC+0LzQtdGAINGC0LXQu9C10YTQvtC90LA6PC9iPiA5OTg5Nzc4MDY3Njc=\"}', 564091431),
(40, '{\"lang\":\"cnU=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9wcm9kdWN0cw==\",\"categoryId\":\"NTA=\"}', 156109685),
(41, '{\"lang\":\"cnU=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9jYXRhbG9n\"}', 44730777),
(42, '{\"lang\":\"cnU=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"NTI=\"}', 348466028),
(43, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\"}', 588056073),
(44, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\"}', 380416481),
(45, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\",\"categoryId\":\"NTI=\",\"productId\":\"MTUw\",\"productOption\":\"OTAw\",\"orderType\":\"ZGVsaXZlcnlUeXBl\",\"firstName\":\"0JjQuNC/\",\"latitude\":\"NDEsMzIxODQ5\",\"longitude\":\"NjksMjEzMDQ2\",\"phoneNumber\":\"MDA5OTk4ODg=\",\"orderText\":\"PGI+WUVUS0FaSUIgQkVSSVNIPC9iPgrinpbinpbinpbinpbinpbinpbinpbinpbinpbinpYKCjxiPkJVWVVSVE1BOjwvYj4K8J+UuCBRYWxhbSAsIDEgZG9uYSAtIDxpPjkwMCBzbydtPC9pPgoK4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6W4p6WCjxiPkphbWk6PC9iPiA8aT45MDAgc28nbTwvaT4KCjxiPklzbTo8L2I+INCY0LjQvwo8Yj5UZWxlZm9uIHJhcWFtOjwvYj4gMDA5OTk4ODg=\"}', 14349913),
(46, '{\"lang\":\"dXo=\",\"quantity\":\"MA==\",\"page\":\"cGFnZV9tYWlu\"}', 985672864);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `texts`
--
ALTER TABLE `texts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `orderproduct`
--
ALTER TABLE `orderproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `texts`
--
ALTER TABLE `texts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
