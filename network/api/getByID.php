<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    //http://127.0.0.1:3456/api/getByID.php?id=1
    include_once("../database/connection.php");
    try {
        //code...
        $id = $_GET['id'];
        if(is_numeric($id)){
            $result = $dbConn->query("SELECT p.id, p.name, p.price, p.image, p.description, p.quantity, p.categoryId 
            from products p where p.id = $id");
        $product = $result->fetch(PDO::FETCH_ASSOC);
        echo json_encode(array(
            "status" => true,
            "data" => $product
        ));
        }
        else{
            echo json_encode(array(
                "status" => false,
                "data" => []
            ));
        }
    } catch (Exception $e) {
        //throw $th;
        echo json_encode(array(
            "status" => false,
            "message"=> $e->getMessage())); 
    }
    
?>