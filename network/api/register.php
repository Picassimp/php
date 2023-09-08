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
    $body = json_decode(file_get_contents("php://input"));

    $email = $body->email;
    $name = $body->name;
    $pswd = $body->password;

    if (empty($email) || empty($pswd) || empty($name)) {
        echo json_encode(array(
            "status" => false,
            "message" => "2"
        ));
        return;
    }

    $user = $dbConn->query("SELECT id, email, password FROM users where email='$email'");

    if ($user->rowCount() > 0) {
        echo json_encode(array(
            "status" => false,
            "message" => "1"
        ));
        return;
    } else {
        $password = password_hash($pswd, PASSWORD_BCRYPT);
        $dbConn->query("INSERT INTO users (email, password, name)
            VALUES ('$email', '$password', '$name')");

        //gui email xac thuc
        $token = md5(time() . $email);
        $link = "<a href='http://127.0.0.1:3456/verifyAccount.php?email="
            . $email . "&token=" . $token . "'>Click to verify</a>";
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
            $mail->Subject = "Verify Acctount";
            $mail->isHTML(true);
            $mail->Body = "Click on this link to verify account " . $link . " ";
            $res = $mail->Send();
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
            //throw $th;
            echo json_encode(array(
                "stasus" => false,
                "message" => $e->getMessage()
            ));
        }

    }
} catch (Exception $e) {
    //throw $th;
    echo json_encode(array(
        "status" => false,
        "message" => $e->getMessage()
    ));
}
