<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once("../database/connection.php");

    try {
        //code...
        $keyword = $_GET['keyword'];
        $products = $dbConn->query("SELECT p.id, p.name, p.price, p.quantity, p.image, p.description, p.categoryID , c.name as categoryName
        FROM products p INNER JOIN categories c
        on p.`categoryID` = c.id where p.name like '%{$keyword}%' order by p.id desc");

        // $products = $dbConn->query("SELECT p.id, p.name, p.price, p.quantity, p.image, p.description, p.categoryID , c.name as lmao
        // FROM products p INNER JOIN categories c
        // on p.`categoryID` = c.id WHERE p.price > 500 AND p.price < 1500");
        $products = $products->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array(
            "status" => true,
            "data" => $products
        ));

    } catch (Exception $e) {
        //throw $th;
        echo json_encode(array(
            "status" => false,
            "loi"=> $e->getMessage())); 
    }
    
?>