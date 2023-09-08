<?php
  include_once("./database/connection.php");
    $result = $dbConn->query("SELECT id, name, image FROM categories");
  try {
    
    $id = $_GET['id'];
    
    if(empty($id) || !is_numeric($id)){
        header("Location: error404.php");
    }
    
    $sql = "SELECT id, name, image FROM categories WHERE id=:id";
    
    $categories = $dbConn->prepare($sql);
    $categories->execute(array(':id' => $id));
    
    if($categories->rowCount() > 0){
    
        while ($row = $categories->fetch(PDO::FETCH_ASSOC)){
        $id = $row['id'];
        $name = $row['name'];
        $image = $row['image'];
    }
    }
    else{
        header("Location: error404.php");
    }
    
} catch (\Throwable $th) {
    
}
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

    $id = $_POST['id'];
    $name = $_POST['name'];
    // bắt lỗi khi người dùng không nhập đủ thông tin
    // upload file

   

    if(empty($fileName)){
        $sql = "Update categories set name='$name' where id=$id" ;
    }else{
        $image = "http://127.0.0.1:3456/upload/".$fileName;
        $sql = "Update categories set name='$name', image='$image'  where id=$id" ;
    }

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
    
    <form class="row g-3" style="padding: 30px;" id="form" action="editCategories.php" method="post" enctype="multipart/form-data">
    <div class="col-md-16">
        <label for="inputEmail4" class="form-label">Tên</label>
        <?php
        echo "<input type='hidden' value='".$id."' name='id'>";
        ?>
        <input type="text" class="form-control" id="inputEmail4" placeholder="name" value="<?php echo $name; ?>" name="name">
    </div>
    
    <div class="col-md-12">
        <label for="inputCity" class="form-label">Hình ảnh</label>
        <input type="file" class="form-control" id="pic" placeholder="pic" name="image">
    </div>
    <div class="col-md-12 d-flex justify-content-center">
        <div class="col-md-3">
            <img id="display" src="<?php echo $image; ?>" class="w-100" alt="">
        </div>
    </div>
    <div class="col-12 d-flex justify-content-center">
        
            <button type="submit" name="submit" class="btn btn-primary">Add category</button>
    </div>
    </form>
</body>

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
</html>