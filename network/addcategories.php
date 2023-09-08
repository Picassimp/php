<?php
session_start();
//kiem tra session
if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}
  include_once("./database/connection.php");
?>

<?php
if (isset($_POST['submit'])) {

    $currentDirectory = getcwd();
    $uploadDirectory = "/upload/";
    $fileName = $_FILES['image']['name'];
    $fileTmpName  = $_FILES['image']['tmp_name'];
    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);
    // upload file
    move_uploaded_file($fileTmpName, $uploadPath);

    $name = $_POST['name'];
    $image = $_POST['image'];
    // bắt lỗi khi người dùng không nhập đủ thông tin
    // upload file

    $image = "http://127.0.0.1:3456/upload/".$fileName;

    $sql = "INSERT INTO categories (name, image)
    VALUES ('$name', '$image')";
    $dbConn->exec($sql);
    // chuyển hướng trang web về index.php
    header("Location: categories.php");
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
    
    <form class="row g-3" style="padding: 30px;" id="form" action="addcategories.php" method="post" enctype="multipart/form-data">
    <div class="col-md-16">
        <label for="inputEmail4" class="form-label">Tên</label>
        <input type="text" class="form-control" id="inputEmail4" placeholder="name" name="name">
    </div>
    
    <div class="col-md-12">
        <label for="inputCity" class="form-label">Hình ảnh</label>
        <input type="file" class="form-control" id="pic" placeholder="pic" name="image">
    </div>
    <div class="col-md-12 d-flex justify-content-center">
        <div class="col-md-3">
            <img id="display" src="https://www.ludiccreatives.com/images/Logo/ludic_creatives_logo2.png" class="w-100" alt="">
        </div>
    </div>
    <div class="col-12 d-flex justify-content-center">
        
            <button type="submit" name="submit" class="btn btn-primary">Add category</button>
    </div>
    </form>
    <script>
    const image = document.querySelector('#pic');
    const display = document.querySelector('#display');

    image.onchange = evt => {
    const [file] = image.files
    if (file) {
        display.src = URL.createObjectURL(file)
    }
    }
</script>
</body>
</html>