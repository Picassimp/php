<?php
include_once("../network/database/connection.php");
try {
    //code...
    $email = $_GET['email'];
    $token = $_GET['token'];
    //kiểm tra email token
    if(empty($email) || empty($token)){
        throw new Exception("Loi");
    }
    //kiểm tra email tồn tại ko
    $user = $dbConn->query("select id from users where email = '$email'");
    if($user->rowCount()==0){
        throw new Exception("email khong ton tai");
    }
    //verify tài khoản trong db
    $dbConn->query("update users set verified = 1 where email = '$email' ");
    //chuyển về login
    header("Location: login.php");
} catch (\Throwable $th) {
    //throw $th;
    header("Location: error404.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực tài khoản</title>
</head>
<body>
    <h1>Xác thực</h1>
</body>
</html>