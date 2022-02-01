<?php
require_once 'include/Telegram.php';
require_once 'include/User.php';
require_once 'include/Pages.php';
require_once 'include/Texts.php';
require_once 'include/Categories.php';
require_once 'include/Products.php';
require_once 'include/ShoppingCart.php';
require_once 'include/OrderProduct.php';
require_once 'include/Profile.php';
require_once 'include/config.php';

$bot_token = BOT_TOKEN;
$rootPath = ROOT_PATH;
$number = DATA_TIME;
$arr = [];
for ($i = 0; $i <= 20; $i++) {
    $arr[] = $i;
}
$telegram = new Telegram($bot_token);
$data = $telegram->getData();
$message = $data['message'];
$text = $message['text'];
$photo = $message['photo'];
$chatID = $telegram->ChatID();
$callback_query = $telegram->Callback_Query();
$callback_data = $telegram->Callback_Data();
$first_name = $telegram->FirstName();
$username = $telegram->Username();
$callback_query = $telegram->Callback_Query();
$callback_data = $telegram->Callback_Data();

$user = new User($chatID);
$texts = new Texts($user->getLanguage());
$categories = new Categories($user->getLanguage());
$products = new Products($user->getLanguage());
init();
// callback buttons
if ($callback_query !== null && $callback_query != '') {
    $callback_data = $telegram->Callback_Data();
    $chatID = $telegram->Callback_ChatID();
    $user = new User($chatID);
    if (strpos($callback_data, 'back') !== false) {
        showProduct($products->getProduct(substr($callback_data, 4)), true);
    } elseif (strpos($callback_data, 'count') !== false) {
        $mdata = explode(',', $callback_data);
        $quantity = substr($mdata[0], 5);
        $optionNum = substr($mdata[1], 5);
        $productId = substr($mdata[2], 9);
        $content = ['chat_id' => $chatID, 'message_id' => $callback_query['message']['message_id'], 'text' => $texts->get('product_added_to_cart')];
        ShoppingCart::addNewOrder($chatID, $productId, $quantity, $optionNum);

        $options = [
            [$telegram->buildInlineKeyboardButton($texts->get('adding_more'), "", "price" . $optionNum . ",productId" . $productId)],
            [$telegram->buildInlineKeyboardButton($texts->get('shopping_btn'), "", "shoppingcart")],
            [$telegram->buildInlineKeyboardButton($texts->get('go_home'), "", "gohome")]

        ];
        $keyb = $telegram->buildInlineKeyBoard($options);
        $content = ['chat_id' => $chatID, 'message_id' => $telegram->MessageID(), 'text' =>$texts->get('product_added_to_cart'), 'reply_markup' => $keyb];
        $telegram->editMessageText($content);
    } elseif (strpos($callback_data, 'price') !== false) {
        $mdata = explode(',', $callback_data);
        $optionNum = substr($mdata[0], 5);
        $productId = substr($mdata[1], 9);
        $user->setProductOption($optionNum);
        showChooseCount($productId, $optionNum);
    }
    elseif ($callback_data == "closeWindow") {
        $content = array('chat_id' => $chatID, 'message_id' => $callback_query['message']['message_id']);
        $telegram->deleteMessage($content);
    }elseif (strpos($callback_data, 'id') !== false) {
        $mdata = explode(",", $callback_data);
        $id = substr($callback_data, 2);
        $optionNum = $mdata[1];
        ShoppingCart::deleteProduct($chatID, $id, $optionNum);
        if (ShoppingCart::getUserProducts($chatID)) {
            showProductsToClear(true);
        } else {
            $content = array('chat_id' => $chatID, 'message_id' => $callback_query['message']['message_id'], 'text' => "Savat bo'sh holatda");
            $telegram->editMessageText($content);
            showMainPage();
        }
    }elseif ($callback_data == "shoppingcart") {
        $content = ['chat_id' => $chatID, 'message_id' => $telegram->MessageID()];
        $telegram->deleteMessage($content);
        showCartPage();
    }elseif ($callback_data == "gohome") {
        $content = ['chat_id' => $chatID, 'message_id' => $telegram->MessageID()];
        $telegram->deleteMessage($content);
        showMainPage();
    }
    //answer nothing with answerCallbackQuery, because it is required
    $content = ['callback_query_id' => $telegram->Callback_ID(), 'text' => "", 'show_alert' => false];
    $telegram->answerCallbackQuery($content);
} elseif ($text == "/start") {
    Profile::profileInsert($chatID,$username, $first_name,datetime());
    $user->setLanguage('uz');
    showStart();
} else{
    switch ($user->getPage()) {
        case Pages::START:
            switch ($text) {
                case "🇺🇿 O'zbekcha":
                    $user->setLanguage('uz');
                    init();
                    showMainPage();
                    break;
                case "🇷🇺 Русский":
                    $user->setLanguage('ru');
                    init();
                    showMainPage();
                    break;
                default:
                    showStart();
                    break;
            }
            break;
        case Pages::MAIN:
            switch ($text) {
                case $texts->get('main_page_btn_1'): // catalog
                    showCategoriesPage();
                    break;
                case $texts->get('main_page_btn_2'): // korzina
                    showCartPage();
                    break;
                case $texts->get('main_page_btn_3'): // yetkazib berish info
                    deliveryInfo();
                    break;
                case $texts->get('main_page_btn_4'): // bizga bog'lanish
                    contact();
                    break;
                case $texts->get('main_page_btn_5'): // til o'zgartirish
                    $user->setLanguage($user->getLanguage() == 'uz' ? 'ru' : 'uz');
                    init();
                    showMainPage();
                    break;

                default:
                    showMainPage();
                    break;
            }
            break;
        case Pages::CATALOG:
            switch ($text) {
                case $texts->get("back_btn"):
                    showMainPage();
                    break;
                case $texts->get("shopping_btn"):
                    showCartPage();
                    break;
                default:
                    if (in_array($text, $categories->getAllNames())) {
                        $categoryId = $categories->getIdByName($text);
                        $user->setCategoryId($categoryId);
                        showProductsPage($categoryId);
                    }
            }
            break;
        case Pages::PRODUCTS:
            switch ($text) {
                case $texts->get("back_btn"):
                    showCategoriesPage();
                    break;
                case $texts->get('show_all'):
                    $productNames = $products->getNamesByCategoryId($user->getCategoryId());
                    foreach ($productNames as $productName) {
                        $productId = $products->getIdByName($productName);
                        showProduct($products->getProduct($productId));
                    }
                    break;
                default:

                    if (in_array($text, $products->getNamesByCategoryId($user->getCategoryId()))) {
                        $productId = $products->getIdByName($text);
                        $user->setProductId($productId);
                        showProduct($products->getProduct($productId));

                    }
                    break;
            }
            break;
        case Pages::SHOPPING_CART:
            switch ($text) {
                case $texts->get('order_count'):
                    showCartPage();
                    break;
                case $texts->get('checkout'):
                    $user->setOrderType('deliveryType');
                    showFirstNamePage();
                    break;
                case $texts->get('change'):
                    showProductsToClear();
                    break;
                case $texts->get('clear'):
                    showClearProducts();
                    break;
                case $texts->get('back_btn'):
                    showMainPage();
                    break;
            }
            break;
        case Pages::FIRST_NAME:
            switch ($text) {
                case $texts->get('back_btn'):
                    showCartPage();
                    break;
                default:
                    OrderProduct::addusername($chatID, $username, $text);
                    $user->setFirstName($text);

                    if ($user->getOrderType() == 'pickupType') {
                        showPhoneNumberPage();
                    } else {
                        showLocationPage();
                    }
                    break;
            }
            break;
        case Pages::PHONE_NUMBER:
            switch ($text) {
                case $texts->get('back_btn'):
                    showLocationPage();
                    break;
                default:
                    if ($message['contact']['phone_number'] != "") {
                        $phone =$message['contact']['phone_number'];
                        OrderProduct::addphonenumber($chatID,$phone);
                        $user->setPhoneNumber($message['contact']['phone_number']);
                    } else {
                        OrderProduct::addphonenumber($chatID,$text);
                        $user->setPhoneNumber($text);
                    }
                    showConfirmOrderPage();
                    break;
            }
            break;
        case Pages::LOCATION:
            switch ($text) {
                case $texts->get('back_btn'):
                    showFirstNamePage();
                    break;
                    default:
                    if ($message['location']['latitude'] && $message['location']['longitude']) {
                        $latitude =$message['location']['latitude'];
                        $longitude=$message['location']['longitude'];
                        OrderProduct::addlocation($chatID,$latitude,$longitude);
                        $user->setLatitude($latitude);
                        $user->setLongitude($longitude);
                        showPhoneNumberPage();
                    }else{
                        showLocationerorPage();
                    }
                    break;
            }
            break;
        case Pages::ORDER_CONFIRMATION:
            switch ($text) {
                case $texts->get('back_btn'):
                    showPhoneNumberPage();
                    break;
                case $texts->get('do_order'):
                    $datetime = datetime();
                    OrderProduct::changestatustoone($chatID,$datetime, 1);
                    $sleepcheck = OrderProduct::checksleeptime($chatID);
                    $mdata = explode(',', $sleepcheck);
                    $mdata2 = explode(':', $mdata[1]);
                    if(in_array($mdata2[0],$number)){
                        showLateConfirmed();
                    }else{
                        showOrderConfirmed();
                    }
                    ShoppingCart::clearShoppingCart($user);
                    break;
                case $texts->get('cancel'):
                    showOrderCanceled();
                    break;
            }
            break;
    }
}

function showStart()
{

    $page = Pages::START;
    $sendText = "Пожалуйста выберите язык. \n\nIltimos, tilni tanlang. 👇";
    $buttons = ["🇷🇺 Русский", "🇺🇿 O'zbekcha"];
    showPage($page, $sendText, $buttons);

}
function showMainPage()
{
    global $texts;
    $page = Pages::MAIN;
    $buttons = $texts->getArrayLike("main_page_btn");
    $textToSend = $texts->get("page_main_text");
    showPage($page, $textToSend, $buttons);
}
function contact(){
    global $texts;
    $phoneNumber = PHONE_NUMBER;
    $username = USERNAME;
    sendMessage('<b>'.$texts->get('contact_page').'</b>' . "\n\n" . "👤 <b>Telegram:</b> " .$username. "\n\n" . "📲 <b>Telefon:</b> " .$phoneNumber);
}
function deliveryInfo(){
    global $texts;
    $phoneNumber = PHONE_NUMBER;
    $username = USERNAME;
    sendMessage('<b>'.$texts->get('delivery_info').'</b>' . "\n\n" . "👤 <b>Telegram:</b> " .$username. "\n\n" . "📲 <b>Telefon:</b> " .$phoneNumber);
}
function showCategoriesPage()
{
    global $texts, $categories;
    $buttons = $categories->getAllNames();
    if (!$buttons) {
        sendMessage($texts->get('page_no_category'));
    } else {
        $page = Pages::CATALOG;
        $textToSend = $texts->get("page_category");
        showPage2($page, $textToSend, $buttons, true);
    }
}
function showProduct($product, $edit = false, $editPrice = "")
{
    global $telegram, $chatID, $rootPath, $texts, $callback_query;

    if ($product['photoUrl']) {
        $photoUrl = $rootPath . $product['photoUrl'];
    } else {
        $photoUrl = $rootPath . "empty-img.png";
    }
    $caption = "";
    if ($product['name']) $caption .= $product['name'];

    $content = ['chat_id' => $chatID, 'text' => "<a href=\"{$photoUrl}\"> </a>" . $caption, 'parse_mode' => "HTML"];
    if ($product['price']) {
        $option = [];

            $name = $product['name'];
            $price =  $product['price'] . " " . $texts->get('soum');
            $option[] = [$telegram->buildInlineKeyboardButton($name . " - " . $price, '', $editPrice ."price" . $product['price'] . ",productId" . $product['id'])];

        $keyb = $telegram->buildInlineKeyBoard($option);
        $content['reply_markup'] = $keyb;
    }
    if ($edit) {
        $content['message_id'] = $callback_query['message']['message_id'];
        $telegram->editMessageText($content);
    } else {
        $telegram->sendMessage($content);
    }
}
function showChooseCount($productId, $optionNum)
{

    global $chatID, $text, $texts, $telegram, $callback_query, $arr;

    $options = [];
    for ($cnt = 0, $i = 0; $i < 4; $i++) {
        for ($j = 0; $j < 5; $j++) {
            $cnt++;
            $options[$i][$j] = $telegram->buildInlineKeyboardButton($arr[$cnt], '', 'count'.$arr[$cnt].',price' . $optionNum . ",productId" . $productId);

        }
    }

    $options[] = [$telegram->buildInlineKeyboardButton($texts->get('back_btn'), "", 'back' . $productId),];

    $keyb = $telegram->buildInlineKeyBoard($options);
    $content = [
        'chat_id' => $chatID,
        'message_id' => $callback_query['message']['message_id'],
        'text' => $texts->get('page_choose_count_text'),
        'reply_markup' => $keyb
    ];
    $telegram->editMessageText($content);
}
function showProductsPage($categoryId)
{
    global $text, $telegram, $chatID, $texts, $products;
    $buttons = $products->getNamesByCategoryId($categoryId);
    if (!$buttons) {
        sendMessage($texts->get('page_no_product'));
    } else {
        $page = Pages::PRODUCTS;
        $textToSend = $texts->get("page_products_text");
        showPage($page, $textToSend, $buttons, true, true);

    }
    if($text=='sonni kiriting:'){

        $content = ['chat_id' => $chatID, 'text' =>$text];
        $telegram->sendMessage($content);
    }
}
function showCartPage(){
    global $user, $telegram, $chatID, $texts, $products;

    if (!ShoppingCart::getUserProducts($chatID)) {
        $content = [
            'chat_id' => $telegram->ChatID(),
            'text' => $texts->get('cart_is_empty')
        ];
        $telegram->sendMessage($content);
    } else {
        $user->setPage(Pages::SHOPPING_CART);
        $content = [
            'chat_id' => $telegram->ChatID(),
            'text' => $texts->get('your_order')
        ];
        $telegram->sendMessage($content);

        $orderText = "";
        $overallPrice = 0;

        foreach (ShoppingCart::getUserProducts($chatID) as $productArr) {
            $productCount = $productArr['count'];
            $optionNum = $productArr['optionNum'];
            $product = $products->getProduct($productArr['id']);
            $price = ((int)($optionNum)) * ((int)($productCount));
            $overallPrice += $price;
            $orderText .= '🔸 '.$product['name'] . ", " . $productCount . " " . $texts->get('pieces') . " - " .'<i>'. number_format($price, 0, "", " ") . " " . $texts->get('soum').'</i>' . "\n\n";
        }

        $orderText .= "➖➖➖➖➖➖➖➖➖➖\n";
        $orderText .= '<b>'.$texts->get('overall').'</b>' . " " .'<i>'. number_format($overallPrice, 0, "", " ") . " " . $texts->get('soum').'</i>';

        $buttons = [$texts->get('order_count'), $texts->get('checkout'),
            $texts->get('change'), $texts->get('clear')];
        sendTextWithKeyboard($buttons, $orderText, true);
    }
}
function showClearProducts()
{
    global $user, $texts;
    ShoppingCart::clearShoppingCart($user);
    sendMessage($texts->get('cart_is_cleared'));
    showMainPage();
}
function showProductsToClear($change = false)
{
    global $telegram, $chatID, $texts, $callback_query, $products;

    $option = [];
    foreach (ShoppingCart::getUserProducts($chatID) as $productArr) {
        $product = $products->getProduct($productArr['id']);
        $optionNum = $productArr['optionNum'];
        $option[] = [$telegram->buildInlineKeyboardButton($product['name'] . " " . $product['options'][$optionNum]['name'], "", "ggg"), $telegram->buildInlineKeyboardButton("❌", "", "id" . $product['id'] . "," . $productArr['optionNum'])];
    }
    $option[] = [$telegram->buildInlineKeyboardButton($texts->get('close_window'), "", "closeWindow")];
    $keyboard = $telegram->buildInlineKeyBoard($option);
    if ($change) {
        $content = array('chat_id' => $chatID, 'message_id' => $callback_query['message']['message_id'], 'reply_markup' => $keyboard, 'text' => $texts->get('press_x_to_clear'), 'parse_mode' => "HTML");
        $telegram->editMessageText($content);
    } else {
        $content = array('chat_id' => $chatID, 'reply_markup' => $keyboard, 'text' => $texts->get('press_x_to_clear'), 'parse_mode' => "HTML");
        $telegram->sendMessage($content);
    }
}
function showFirstNamePage()
{
    global $texts;
    $page = Pages::FIRST_NAME;
    $textToSend = $texts->get('enter_your_name');
    showPage($page, $textToSend, [], true);
}
function showPhoneNumberPage()
{
    global $user, $telegram, $chatID, $texts;
    $user->setPage(Pages::PHONE_NUMBER);
    $option = [
        [$telegram->buildKeyboardButton($texts->get('send_contact'), true, false)],
        [$telegram->buildKeyboardButton($texts->get('back_btn'))],
    ];
    $keyboard = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyboard, 'text' => $texts->get('send_your_phone_number'), 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}
function showLocationPage()
{
    global $user, $telegram, $chatID, $texts;
    $user->setPage(Pages::LOCATION);
    $option = [
        [$telegram->buildKeyboardButton($texts->get('send_location'), false, true)],
//        [$telegram->buildKeyboardButton($texts->('cant_send_location'))],
        [$telegram->buildKeyboardButton($texts->get('back_btn'))],
    ];
    $keyboard = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyboard, 'text' => $texts->get('send_your_location'), 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}
function showLocationerorPage()
{
    global $user, $telegram, $chatID, $texts;
    $user->setPage(Pages::LOCATION);
    $option = [
        [$telegram->buildKeyboardButton($texts->get('send_location'), false, true)],
//        [$telegram->buildKeyboardButton($texts->('cant_send_location'))],
        [$telegram->buildKeyboardButton($texts->get('back_btn'))],
    ];
    $keyboard = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyboard, 'text' => $texts->get('location_error'), 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}
function showConfirmOrderPage()
{
    global $user, $telegram, $chatID, $texts, $products;
    $page = Pages::ORDER_CONFIRMATION;

    // start building order text
    $orderText = "<b>" . strtoupper($texts->get($user->getOrderType())) . "</b>";
    $orderText .= "\n➖➖➖➖➖➖➖➖➖➖\n\n";
    $orderText .= $texts->get('order') . "\n";

    $overallPrice = 0;
$fordb ='';
    foreach (ShoppingCart::getUserProducts($chatID) as $productArr) {
        $productCount = $productArr['count'];
        $optionNum = $productArr['optionNum'];
        $product = $products->getProduct($productArr['id']);
        $price = ((int)($optionNum)) * ((int)($productCount));
        $overallPrice += $price;
        $orderText .= '🔸 '.$product['name'] . " " .  ", " . $productCount . " " . $texts->get('pieces') . " - "  .'<i>'. number_format($price, 0, "", " ") . " " . $texts->get('soum').'</i>' . "\n\n";
        $fordb .= '<li>'.$product['name']. ', '.$productCount. ' ta '.' - '.number_format($price, 0, "", " ") . ' so\'m'.'</li>';
    }

    $orderText .= "➖➖➖➖➖➖➖➖➖➖➖➖➖\n";
    $orderText .= '<b>'.$texts->get('overall').'</b>' . " " .'<i>'. number_format($overallPrice, 0, "", " ") . " " . $texts->get('soum').'</i>';
    $orderText .= "\n\n<b>{$texts->get('name')}</b> " . $user->getFirstName();
    $orderText .= "\n<b>{$texts->get('phone_number')}</b> " . $user->getPhoneNumber();
    // end building order text
    OrderProduct::setproduct($chatID,$overallPrice,$fordb);
    $user->setOrderText($orderText);
    // save ready order text

    $buttons = [$texts->get('do_order'), $texts->get('cancel')];
    showPage($page, $orderText, $buttons, true);

    if ($user->getLongitude() != "" && $user->getLatitude() != "") {
        $latitude = str_replace(",", ".", $user->getLatitude());
        $longitude = str_replace(",", ".", $user->getLongitude());
        $content = array('chat_id' => $chatID, 'latitude' => $latitude, 'longitude' => $longitude);
        $telegram->sendLocation($content);
    }
}
function showOrderConfirmed()
{
    global $telegram, $chatID, $texts;

    $content = array('chat_id' => $chatID, 'text' =>$texts->get('order_confirmed'), 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
    showMainPage();


}
function showLateConfirmed()
{
    global $telegram, $chatID, $texts;

    $content = array('chat_id' => $chatID, 'text' =>$texts->get('sleep_check'), 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
    showMainPage();


}
function showOrderCanceled()
{
    global $texts;
    sendMessage($texts->get('order_canceled'));
    showMainPage();
}

// helper functions
function sendTextWithKeyboard($buttons, $text, $backBtn = false, $allButton = false)
{
    global $telegram, $chatID, $texts;
    $option = [];
    if ($allButton) {
        $option[] = array($telegram->buildKeyboardButton($texts->get('show_all')));
    }
    if (count($buttons) % 2 == 0) {
        for ($i = 0; $i < count($buttons); $i += 2) {
            $option[] = array($telegram->buildKeyboardButton($buttons[$i]), $telegram->buildKeyboardButton($buttons[$i + 1]));
        }
    } else {
        for ($i = 0; $i < count($buttons) - 1; $i += 2) {
            $option[] = array($telegram->buildKeyboardButton($buttons[$i]), $telegram->buildKeyboardButton($buttons[$i + 1]));
        }
        $option[] = array($telegram->buildKeyboardButton(end($buttons)));
    }
    if ($backBtn) {
        $option[] = [$telegram->buildKeyboardButton($texts->get("back_btn"))];
    }
    $keyboard = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyboard, 'text' => $text, 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}
function sendTextWithThreeKeyboard($backBtn = false, $buttons, $text)
{
    global $telegram, $chatID, $texts;
    $option = [];

    if ($backBtn) {
        $option[] = [
            $telegram->buildKeyboardButton($texts->get("shopping_btn")),
            $telegram->buildKeyboardButton($texts->get("back_btn"))

        ];
    }

    if (count($buttons) % 3 == 0) {
        for ($i = 0; $i < count($buttons); $i += 3) {
            $option[] = array($telegram->buildKeyboardButton($buttons[$i]), $telegram->buildKeyboardButton($buttons[$i + 1]), $telegram->buildKeyboardButton($buttons[$i + 2]));
        }
    } else {
        for ($i = 0; $i < count($buttons) - 1; $i += 3) {
            $option[] = array($telegram->buildKeyboardButton($buttons[$i]), $telegram->buildKeyboardButton($buttons[$i + 1]), $telegram->buildKeyboardButton($buttons[$i + 1]));
        }
        $option[] = array($telegram->buildKeyboardButton(end($buttons)));
    }

    $keyboard = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chatID, 'reply_markup' => $keyboard, 'text' => $text, 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}
function showPage2($page, $text,  $buttons = [], $backBtn = false)
{
    global $user;
    $user->setPage($page);
    sendTextWithThreeKeyboard($backBtn, $buttons, $text);
}
function showPage($page, $text, $buttons = [], $backBtn = false, $allButton = false)
{
    global $user;
    $user->setPage($page);
    sendTextWithKeyboard($buttons, $text, $backBtn, $allButton);
}
function init()
{
    global $chatID, $user, $texts;
    $user = new User($chatID);
    $texts = new Texts($user->getLanguage());
    $categories = new Categories($user->getLanguage());
    $products = new Products($user->getLanguage());

}
function sendMessage($text)
{
    global $telegram, $chatID;
    $telegram->sendMessage(['chat_id' => $chatID, 'text' => $text, 'parse_mode' => 'HTML']);
}
function sendChooseButtons()
{
    sendMessage("Iltimos, quyidagi tugmalardan birini tanlang.");
}
function datetime(){
    date_default_timezone_set("Asia/Tashkent");
    $CurrentTime=time();
    $DateTime=strftime("%d.%m.%Y,%H:%M",$CurrentTime);
    return $DateTime;
}


