<?php
    session_start();
    //kiem tra session
    if(!isset($_SESSION['email'])){
        header("Location: login.php");
        exit();
    }
  include_once("./database/connection.php");
  $result = $dbConn->query("SELECT id, name, price, quantity, image FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Danh sách sản phẩm</title>
</head>
<body style="background-color: #eee;" class="posision-relative">
  <div class="container py-5 ">
    <div class="row justify-content-center mb-3">
        <div class='col-md-12 col-xl-10'>
            <h2>Danh sách sản phẩm</h2>  
            <a href='logout.php' class='btn btn-primary btn-sm'>Thoát</a>
        </div>
    </div>
    <div class="position-fixed bottom-0 end-0 m-4">
        <a href='add2.php' class='btn btn-success rounded-circle'>+</a>    
    </div>
    <?php
        while($row =  $result -> fetch(PDO::FETCH_ASSOC)) {
          echo "<div class='row justify-content-center mb-3'>";
            echo "<div class='col-md-12 col-xl-10'>";
                echo "<div class='card shadow-0 border rounded-3'>";
                    echo "<div class='card-body'>";
                        echo "<div class='row'>";
                            echo "<div class='col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0'>";
                                echo "<div class='bg-image hover-zoom ripple rounded ripple-surface'>";
                                    echo "<img src='" . $row['image'] . "' class='w-100'></td>";
                                    echo "<a href='#!'>";
                                        echo "<div class='hover-overlay'>";
                                            echo "<div class='mask' style='background-color: rgba(253, 253, 253, 0.15);'></div>";
                                        echo "</div>";
                                    echo "</a>";
                                echo "</div>";
                            echo "</div>";
                            echo "<div class='col-md-6 col-lg-6 col-xl-6'>";
                                echo "
                                <h5>". $row['name'] ."</h5>
                                <div class='d-flex flex-row'>
                                <span>Giá: ". $row['price'] ."</span>
                                </div>
                                <div class='mt-1 mb-0 text-muted small'>
                                <span>Số lượng: ". $row['quantity'] ."</span>
                                </div>
                                <p class='text-truncate mb-4 mb-md-0 vh-50'>
                                There are many variations of passages of Lorem Ipsum available, but the
                                majority have suffered alteration in some form, by injected humour, or
                                randomised words which don't look even slightly believable.
                                </p>
                                ";
                            echo "</div>";
                            echo "<div class='col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start'>";
                                echo "
                                <div class='d-flex flex-column mt-4'>
                                <a href='edit.php?id=".$row['id']."' class='btn btn-primary btn-sm'>Sửa</a>
                                <a onclick='confirmDelete(".$row['id'].")' class='btn btn-outline-primary btn-sm mt-2'>
                                    Xóa
                                </a>
                                </div>
                                ";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
          echo "</div>";
        };
      ?>
  </div>

</body>

<script>
    const confirmDelete = (id) =>{
        swal({
        title: "Xác nhận xóa?",
        text: "Xóa xong là cook!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location.href = "delete.php?id=" +id;
           
        } else {
            
        }
        });
    }
</script>

</html>