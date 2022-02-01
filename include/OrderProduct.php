<?php
require_once 'db_connect.php';
class OrderProduct
{

static function addusername($chat_id,$username, $name){
    global $db;
    $chat_id = $db->real_escape_string($chat_id);
    $username = $db->real_escape_string($username);
    $name = $db->real_escape_string($name);
    $checkuserexist = $db->query("SELECT * FROM `orderproduct` WHERE `chat_id`='{$chat_id}'");
    if (mysqli_num_rows($checkuserexist) == 0) {
        $db->query("INSERT INTO `orderproduct` (`chat_id`, `username`, `name`) VALUES ('{$chat_id}', '{$username}', '{$name}')");
    } else {
        $arr = $checkuserexist->fetch_assoc();
        $id = $arr['id'];
        $db->query("UPDATE `orderproduct` SET `username` = '$username',`name` = '$name' WHERE `orderproduct`.`id` = '$id'");
    }
}
    static function addphonenumber($chat_id,$phone){
        global $db;

        $phone = $db->real_escape_string($phone);
        $checkuserexist = $db->query("SELECT * FROM `orderproduct` WHERE `chat_id`='{$chat_id}'");

            $arr = $checkuserexist->fetch_assoc();
            $id = $arr['id'];
            $db->query("UPDATE `orderproduct` SET `tel` = '$phone' WHERE `orderproduct`.`id` = '$id'");

    }
    static function addlocation($chat_id,$latitude,$longitude){
        global $db;

        $latitude = $db->real_escape_string($latitude);
        $longitude = $db->real_escape_string($longitude);
        $checkuserexist = $db->query("SELECT * FROM `orderproduct` WHERE `chat_id`='{$chat_id}'");

        $arr = $checkuserexist->fetch_assoc();
        $id = $arr['id'];
        $db->query("UPDATE `orderproduct` SET `latitude` = '$latitude',`longitude` = '$longitude' WHERE `orderproduct`.`id` = '$id'");

    }
    static function changestatustoone($chat_id,$date,$status){
        global $db;

        $status = $db->real_escape_string($status);

        $checkuserexist = $db->query("SELECT * FROM `orderproduct` WHERE `chat_id`='{$chat_id}'");

        $arr = $checkuserexist->fetch_assoc();
        $id = $arr['id'];
        $db->query("UPDATE `orderproduct` SET `status` = '$status',`date` = '$date' WHERE `orderproduct`.`id` = '$id'");

    }
    static function setproduct($chat_id,$price,$text){
        global $db;

        $price = $db->real_escape_string($price);
        $text = $db->real_escape_string($text);

        $checkuserexist = $db->query("SELECT * FROM `orderproduct` WHERE `chat_id`='{$chat_id}'");

        $arr = $checkuserexist->fetch_assoc();

        $id = $arr['id'];
        $db->query("UPDATE `orderproduct` SET `overallprice` = '$price',`product` = '$text' WHERE `orderproduct`.`id` = '$id'");

    }

    static function checksleeptime($chat_id) {
        global $db;
        $userID = $db->real_escape_string($chat_id);

        $res = [];

        $query = "SELECT * FROM `orderproduct` WHERE `chat_id` = '{$chat_id}'";

        $result = $db->query($query);

        while ($arr = $result->fetch_assoc()) {
            if (isset($arr['id'])) {

                $datetime = $arr['date'];

            }
        }

        return $datetime;
    }

}
