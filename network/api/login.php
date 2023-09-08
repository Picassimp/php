<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once("../database/connection.php");
    try {
        //code...
        $body = json_decode(file_get_contents("php://input"));

        

        $email = $body->email;
        $pswd = $body->password;

        if(empty($email) || empty($pswd)){
            echo json_encode(array(
                "status" => false,
            "message" => "toang"));     
            return;
        }

        $user = $dbConn->query("SELECT id, name, email, password FROM users WHERE email='$email'");

        if($user->rowCount() > 0){
        //lấy thông tin users
        $row = $user->fetch(PDO::FETCH_ASSOC);
        $id = $row['id'];
        $email = $row['email'];
        $name = $row['name'];
        $password = $row['password'];
        //kiểm tra mật khẩu
            if(password_verify($pswd, $password)){
                //chuyển về trang index
                echo json_encode(array(
                    "status" => true,
                    "message" => $name));
            }
            else{
                echo json_encode(array(
                    "status" => false,
                    "message" => "toang"));
            }
        }
        else{
            echo json_encode(array(
                "status" => false,
                "message" => "toang"));
        }
    } catch (\Throwable $th) {
        //throw $th;
    }
    
?>