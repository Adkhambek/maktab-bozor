<?php
require_once '../include/config.php';
$token = BOT_TOKEN;
$admin = ADMIN_CHAT_ID;

function send($lat, $long)
{
    global $token, $admin;
    define('url', "https://api.telegram.org/bot" . $token);
    foreach ($admin as $chat_id) {

        file_get_contents(url . "/sendLocation?chat_id=" . $chat_id . "&latitude=" . $lat . "&longitude=" . $long);
    }

}
