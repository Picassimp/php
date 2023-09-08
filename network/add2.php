<?php
session_start();
//kiem tra session
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
include_once("./database/connection.php");
$result = $dbConn->query("SELECT id, name, image FROM categories");
?>

<?php
if (isset($_POST['submit'])) {

    //upload vào server
    // $currentDirectory = getcwd();
    // $uploadDirectory = "/upload/";
    // $fileName = $_FILES['image']['name'];
    // $fileTmpName  = $_FILES['image']['tmp_name'];
    // $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);
    // // upload file
    // move_uploaded_file($fileTmpName, $uploadPath);

    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['imgUrl'];
    $categoryId = $_POST['categoryId'];
    $description = $_POST['description'];
    // bắt lỗi khi người dùng không nhập đủ thông tin
    // upload file

    // $image = "http://127.0.0.1:3456/upload/".$fileName;

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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- firebase -->
    <script src="https://www.gstatic.com/firebasejs/5.4.0/firebase.js"></script>
    <title>Document</title>
</head>

<body style="margin-left: 30px; margin-right: 30px;">

    <form id="form" class="row g-3" style="padding: 30px;" name="form" action="add2.php" method="post" enctype="multipart/form-data">
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" placeholder="name" name="name">
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
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-12">
            <label for="inputCity" class="form-label">Hình ảnh</label>
            <input onchange="onChangeImage()" type="file" class="form-control" id="pic" placeholder="pic" name="image">
        </div>
        <div class="col-md-12 d-flex justify-content-center">
            <div class="col-md-3">
                <img onchange="onChangeImage()" id="display" class="w-100" alt="hinh anh">
                <input type="hidden" name="imgUrl" id="imgUrl">
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
<script>
    const form = document.querySelector('#form');

    form.addEventListener('submit', function(e) {
        const name = document.querySelector('#name').value;
        if (!name || name.trim().lenght === 0) {
            swal('Vui lòng nhập tên sản phẩm');
            e.preventDefault();
            return false;
        }
        return true;
    });

    const firebaseConfig = {
        apiKey: "AIzaSyBcQqqoYYSy07IrMlQIi0I64NG2mBY6i78",
        authDomain: "project001-e6de6.firebaseapp.com",
        projectId: "project001-e6de6",
        storageBucket: "project001-e6de6.appspot.com",
        messagingSenderId: "777858839707",
        appId: "1:777858839707:web:a2c5fb79be38131d67423e"
    };

    firebase.initializeApp(firebaseConfig);
</script>

<script>
    // const image = document.querySelector('#pic');
    // const display = document.querySelector('#display');

    // image.onchange = evt => {
    //     const [file] = image.files
    //     if (file) {
    //         display.src = URL.createObjectURL(file)
    //     }
    // }

    //upload firebase khi upload

    const onChangeImage = () => {
        const file = document.getElementById('pic').files[0];
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('display').src = e.target.result;
        }
        reader.readAsDataURL(file);
        //upload lên firebase
        const ref = firebase.storage().ref(new Date().getTime() + '-' + file.name);
        const uploadTask = ref.put(file);
        uploadTask.on(firebase.storage.TaskEvent.STATE_CHANGED,
            (snapshot) => {},
            (error) => {
                console.log('firebase error: ', error)
            },
            () => {
                uploadTask.snapshot.ref.getDownloadURL().then(url => {
                    console.log('>>>>> File available at:', url);
                    document.getElementById('imgUrl').value=url;
                })
            }
        );
    }
</script>

</html>