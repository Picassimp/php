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
    header("Location: index.php");
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
<body>
    <div class="container mt-3">
        <h2>Stacked form</h2>
        <form id="form" action="add.php" method="post">
            <div class="mb-3 mt-3">
                <label for="name">Tên:</label>
                <input type="text" class="form-control" id="name" placeholder="name" name="name">
            </div>
            <div class="mb-3">
                <label for="price">Giá:</label>
                <input type="number" class="form-control" id="price" placeholder="price" name="price">
            </div>
            <div class="mb-3">
                <label for="quantity">Số lượng:</label>
                <input type="number" class="form-control" id="quantity" placeholder="quantity" name="quantity">
            </div>
            <div class="mb-3">
                <label for="pic">Hình ảnh:</label>
                <input type="file" class="form-control" id="pic" placeholder="pic" name="image">
                <img src="https://www.ludiccreatives.com/images/Logo/ludic_creatives_logo2.png" alt="">
            </div>
            <div class="mb-3">
                <label for="pic">Nhà cung cấp:</label>
                <select class="form-control" id="supplier" name="categoryId">
                    
                    <?php
                        while($row = $result->fetch(PDO::FETCH_ASSOC)){
                            echo "<option value='" . $row['id']."'>".$row['name']."</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="mb-3 mt-3">
                <label for="description">Mô tả:</label>
                <textarea class="form-control" id="description" placeholder="Enter description" name="description"></textarea>
            </div>



            
    
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script>
        const form = document.querySelector('#form');
        
    </script>
</body>
</html>