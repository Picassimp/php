<?php
include('./database/connection.php');
//get
if(!isset($_POST['submit'])){
    $email = $_GET['email'];
    $token = $_GET['token'];
    if(empty($email) || empty($token)){
        header("Location: error404.php");
        exit();
    }

    //kt token
    $result = $dbConn->query("
    Select id from reset_password where email = '$email'
    and token = '$token'
    and timeCreated >= DATE_SUB(NOW(), INTERVAL 1 HOUR)
    and avaiable = 1
    ");

    $user = $result->fetch(PDO::FETCH_ASSOC);
    if(!$user){
        header("Location: error404.php");
        exit();
    }
}
//post
else{
    $email = $_POST['email'];
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password != $confirm_password){
        header("Location: error404.php");
        exit();
    }

    //kt token
    $result = $dbConn->query("Select id from reset_password where email = '$email'
    and token = '$token'
    and timeCreated >= DATE_SUB(NOW(), INTERVAL 1 HOUR)
    and avaiable = 1");

    $user = $result->fetch(PDO::FETCH_ASSOC);
    if(!$user){
        header("Location: error404.php");
        exit();
    }

    //cap nhat mk
    $password = password_hash($password, PASSWORD_BCRYPT);
    $dbConn->query("
    update users set password = '$password' where email = '$email' ");
    //huy token
    $dbConn->query("
    update reset_password set avaiable = 0  where email = '$email' and token = '$token' ");
    header("Location: login.php");
    
}
?>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset password</title>
</head>

<body>
    <form action="resetPassword.php" method="post">
        <input type="password" name="password" placeholder="Mat khau moi">
        <input type="password" name="confirm_password" placeholder="Nhap lai mat khau">
        <input type="text" name="email" value="<?php echo $_GET['email'] ?>">
        <input type="text" name="token" value="<?php echo $_GET['token'] ?>">
        <button type="submit" name="submit">Khoi phuc</button>
    </form>
</body>

</html>