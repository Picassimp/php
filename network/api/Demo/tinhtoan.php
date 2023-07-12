<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    //lấy dữ liệu client gửi lên
    //http://127.0.0.1:3456/api/demo/tinhtoan.php?a=5&b=3&c=7
    $a = $_GET['a'];
    $b = $_GET['b'];
    $c = $_GET['c'];

    // $tong = $a + $b;
    // $hieu = $a - $b;
    // $tich = $a * $b;
    // $thuong = $a / $b;

    $detal = $b*$b - 4 * $a * $c;
    $kq1 = 0;
    $kq2 = 0;

    if($detal > 0){
        $kq1 = (-$b + sqrt($detal))/(2*$a);
        $kq2 = (-$b - sqrt($detal))/(2*$a);
        echo json_encode(
        array(
            "kq" => "2 Nghiệm",
            "x1" => $kq1,
            "x2" => $kq2,
        ) 
        );
        return;
    }

    elseif($detal = 0){
        $kq1 = (-$b)/(2*$a);
        echo json_encode(
        array(
            "kq" => "1 Nghiệm",
            "x" => $kq1,
        )
        );
        return;
    }
    else{
        echo json_encode(
        array(
            "kq" => "0 Nghiệm",
        )
        );
        return;
    }
    
?>