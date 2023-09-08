<?php
// http://127.0.0.1:3456/edit.php?id=1
//including the database connection file
include('./database/connection.php');
$result = $dbConn->query("SELECT id, name, image FROM categories");
//getting id of the data from url

try {
    
    $id = $_GET['id'];

    if(empty($id) || !is_numeric($id)){
        header("Location: error404.php");
    }
    
    $sql = "SELECT id, name, price, quantity, image, description,  categoryId  FROM products WHERE id=:id";
    
    $product = $dbConn->prepare($sql);
    $product->execute(array(':id' => $id));
    if($product->rowCount() > 0){
    
        while ($row = $product->fetch(PDO::FETCH_ASSOC)){
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
        $image = $row['image'];
        $description = $row['description'];
        $quantity = $row['quantity'];
        $categoryId = $row['categoryId'];
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
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $categoryId = $_POST['categoryId'];
    $description = $_POST['description'];
    // bắt lỗi khi người dùng không nhập đủ thông tin
    // upload file

   

    if(empty($fileName)){
        $sql = "Update products set name='$name', price='$price', quantity='$quantity',
         categoryId='$categoryId', description='$description'  where id=$id" ;
    }else{
        $image = "http://127.0.0.1:3456/upload/".$fileName;
        $sql = "Update products set name='$name', price='$price', quantity='$quantity',
    image='$image', categoryId='$categoryId', description='$description'  where id=$id" ;
    }

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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Document</title>
</head>
<body style="margin-left: 30px; margin-right: 30px;">
    
    <form id="form" class="row g-3" style="padding: 30px;" name="form" action="edit.php?id<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Tên</label>
        <?php
        echo "<input type='hidden' value='".$id."' name='id'>";
        ?>
        <?php
        echo "<input type='text' value='".$name."' class='form-control' id='name' placeholder='name' name='name'>";
        ?>
        
    </div>
    <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Giá</label>
        <?php
        echo "<input type='number' value='".$price."' class='form-control' id='price' placeholder='price' name='price'>";
        ?>
    </div>
    <div class="col-6">
        <label for="inputAddress" class="form-label">Số lượng</label>
        <?php
        echo "<input type='number' value='".$quantity."' class='form-control' id='quantity' placeholder='quantity' name='quantity'>";
        ?>
    </div>
    <div class="col-6">
        <label for="inputAddress2" class="form-label">Nhà cung cấp</label>
        <select class="form-control" id="supplier" name="categoryId">
                        
                        <?php
                            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                if($row['id'] == $categoryId){
                                    echo "<option selected value='" . $row['id']."'>".$row['name']."</option>";
                                }
                                else{
                                    echo "<option value='" . $row['id']."'>".$row['name']."</option>";
                                }
                               
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
            <?php
                echo "<img src='".$image."' id='display' class='w-100' alt='Hình ko tồn tại'>";
            ?>
        </div>
    </div>
    <div class="col-md-12">
        <label for="inputZip" class="form-label">Mô tả:</label>
        <?php
            echo "<textarea class='form-control' id='description' placeholder='Enter description' name='description'>".$description."</textarea>";
        ?>
        
    </div>
    <div class="col-12 d-flex justify-content-center">
        
            <button type="submit" name="submit" class="btn btn-primary">Sửa</button>
    </div>
    </form>

    

    <script>
        const form = document.querySelector('#form');

        form.addEventListener('submit', function(e){
            const name = document.querySelector('#name').value;
            if(!name || name.trim().lenght ===0){
                swal('Vui lòng nhập tên sản phẩm');
                e.preventDefault();
                return false;
            }
            return true;
        });
</script>

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