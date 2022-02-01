<?php

class Products
{
    /**
     * @var string
     */
    private $lang;

    /**
     * Districts constructor.
     * @param string $lang
     */
    public function __construct($lang)
    {
        $this->lang = $lang;
    }

    function getNamesByCategoryId($categoryId)
    {
        global $db;
        $categoryId = $db->real_escape_string($categoryId);
        $products = [];
        $result = $db->query("SELECT * FROM `products` WHERE `categoryId` = '{$categoryId}'");
        while ($arr = $result->fetch_assoc()) {
            if (isset($arr[$this->lang])) {
                $products[] = $arr[$this->lang];
            }
        }
        return $products;
    }

    function getIdByName($name)
    {
        global $db;
        $id = "";
        $name = $db->real_escape_string($name);
        $result = $db->query("SELECT * FROM `products` WHERE {$this->lang}='$name' LIMIT 1");
        $arr = $result->fetch_assoc();
        if (isset($arr["id"])) {
            $id = $arr["id"];
        }
        return $id;
    }

    function getProduct($productId)
    {
        global $db;
        $result = $db->query("SELECT * FROM `products` WHERE `id`='{$productId}' LIMIT 1");
        $arr = $result->fetch_assoc();
        $arr['name'] = $arr[$this->lang];
        $arr['options'] = json_decode($arr['options'], true);
        $arr['prices'] = json_decode($arr['prices'], true);
        return $arr;
    }



}