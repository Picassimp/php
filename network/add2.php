<?php
  include_once("./database/connection.php");
  $result = $dbConn->query("SELECT id, name, image FROM categories");
?>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];
    $categoryId = $_POST['categoryId'];
    $description = $_POST['description'];
    // bắt lỗi khi người dùng không nhập đủ thông tin
    // upload file

    $image = "https://www.ludiccreatives.com/images/Logo/ludic_creatives_logo2.png";

    $sql = "INSERT INTO products (name, price, quantity, image, categoryId, description)
    VALUES ('$name', '$price', '$quantity', '$image', '$categoryId', '$description')";
    $dbConn->exec($sql);
    // chuyển hướng trang web về index.php
    header("Location: index2.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body style="margin-left: 30px; margin-right: 30px;">
    
    <form class="row g-3" style="padding: 30px;" id="form" action="add2.php" method="post">
    <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Tên</label>
        <input type="text" class="form-control" id="inputEmail4" placeholder="name" name="name">
    </div>
    <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Giá</label>
        <input type="number" class="form-control" placeholder="price" name="price">
    </div>
    <div class="col-6">
        <label for="inputAddress" class="form-label">Số lượng</label>
        <input type="number" class="form-control" id="inputAddress" placeholder="quantity" name="quantity">
    </div>
    <div class="col-6">
        <label for="inputAddress2" class="form-label">Nhà cung cấp</label>
        <select class="form-control" id="supplier" name="categoryId">
                        
                        <?php
                            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                echo "<option value='" . $row['id']."'>".$row['name']."</option>";
                            }
                        ?>
                    </select>
    </div>
    <div class="col-md-12">
        <label for="inputCity" class="form-label">Hình ảnh</label>
        <input type="file" class="form-control" id="pic" placeholder="pic" name="image">
    </div>
    <div class="col-md-12 d-flex justify-content-center">
        <div class="col-md-3">
            <img src="https://www.ludiccreatives.com/images/Logo/ludic_creatives_logo2.png" class="w-100" alt="">
        </div>
    </div>
    <div class="col-md-12">
        <label for="inputZip" class="form-label">Mô tả:</label>
        <textarea class="form-control" id="description" placeholder="Enter description" name="description"></textarea>
    </div>
    <div class="col-12 d-flex justify-content-center">
        
            <button type="submit" name="submit" class="btn btn-primary">Sign in</button>
    </div>
    </form>
</body>
</html>