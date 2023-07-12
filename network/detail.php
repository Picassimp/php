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
        <form action="/action_page.php">
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
                <input type="file" class="form-control" id="pic" placeholder="pic" name="pic">
                <img src="https://www.ludiccreatives.com/images/Logo/ludic_creatives_logo2.png" alt="">
            </div>
            <div class="mb-3">
                <label for="pic">Nhà cung cấp:</label>
                <select class="form-control" id="supplier" name="supplier">
                    <option value="1">Apple</option>
                    <option value="2">Samsung</option>
                    <option value="3">Xiaomi</option>
                </select>
            </div>

            <div class="mb-3 mt-3">
                <label for="description">Mô tả:</label>
                <textarea class="form-control" id="description" placeholder="Enter description" name="description"></textarea>
            </div>



            
    
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>