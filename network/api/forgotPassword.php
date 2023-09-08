<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../database/connection.php");

use PHPMailer\PHPMailer\PHPMailer;

include_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/PHPMailer-master/src/PHPMailer.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/PHPMailer-master/src/SMTP.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/PHPMailer-master/src/Exception.php';
try {
    // lấy email từ body
    $data = json_decode(file_get_contents("php://input"));
    $email = $data->email;
    $result = $dbConn->query("Select id from users where email = '$email'");
    $user = $result->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        throw new Exception("Email chưa đăng ký");
    }
    //tạo token
    $token = md5(time() . $email);
    //lưu bào db
    $dbConn->query("Insert into reset_password (email, token) values ('$email', '$token')");
    //gửi link
    $link = "<a href='http://127.0.0.1:3456/resetPassword.php?email="
        . $email . "&token=" . $token . "'>Click to reset password</a>";
    $mail = new PHPMailer();
    try {
        //code...
        $mail->CharSet = "utf-8";
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Username = "leviettinh1001";
        $mail->Password = "kkvykxsqabzmiuzl";
        // $mail->Username = "vulqps24441";
        // $mail->Password = "tykbolesfzgyovev";
        $mail->SMTPSecure = "ssl";
        $mail->Host = "ssl://smtp.gmail.com";
        $mail->Port = "465";
        $mail->From = "leviettinh1001@gmail.com";
        // $mail->From = "vulqps24441@fpt.edu.vn";
        $mail->FromName = "Nguyễn Anh Hùng";
        $mail->addAddress($email, 'Hello');
        $mail->Subject = "Reset Password";
        $mail->isHTML(true);
        $mail->Body = "Click on this link to reset password " . $link . " ";
        $res = $mail->Send();
    } catch (Exception $e) {
        //throw $th;
        echo json_encode(array(
            "stasus" => false,
            "message" => $e->getMessage()
        ));
    }


    if ($res) {
        echo json_encode(array(
            "stasus" => true,
            "message" => "Email sent."
        ));
    } else {
        echo json_encode(array(
            "stasus" => false,
            "message" => "Fail."
        ));
    }
} catch (Exception $e) {
    echo json_encode(array(
        "stasus" => false,
        "message" => $e->getMessage()
    ));
}
