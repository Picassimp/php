<?php
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
    <title>Danh sách sản phẩm</title>
</head>
<body>
<div class="container mt-3">
  <h2>Danh sách sản phẩm</h2>  
  <a href='add.php' class='btn btn-success'>Thêm</a>        
  <table class="table">
    <thead>
      <tr>
        <th>Tên</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Hình ảnh</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
      

      <?php
        while($row =  $result -> fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          echo "<td>" . $row['name'] . "</td>";
          echo "<td>" . $row['price'] . "</td>";
          echo "<td>" . $row['quantity'] . "</td>";
          echo "<td> <img src='" . $row['image'] . "' width='100'></td>";
          echo "<td>
                  <a href='#' class='btn btn-primary'>Sửa</a>
                  <a href='#' class='btn btn-primary'>Xóa</a>
                </td>";
          echo "</tr>";
        };
      ?>
      
    </tbody>
  </table>
</div>
</body>
</html>