<?php
  include_once("./database/connection.php");
  $result = $dbConn->query("SELECT id, name, image FROM categories");
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
<body class="position-relative">
    <div class="position-fixed bottom-0 end-0 m-4">
        <a href='addcategories.php' class='btn btn-success rounded-circle'>+</a>    
    </div>
    <section style="background-color: #eee;">
    <div class="text-center container py-5">
        <h4 class="mt-4 mb-5"><strong>Categories</strong></h4>

        <div class="row">
            
            <?php
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    echo "
                    <div class='col-lg-4 col-md-12 mb-4'>
                        <div class='card'>
                        <div class='bg-image hover-zoom ripple ripple-surface ripple-surface-light'
                            data-mdb-ripple-color='light'>
                            <img src=". $row['image'] ."
                            class='w-100' />
                            <a href='#!'>
                            <div class='hover-overlay'>
                                <div class='mask' style='background-color: rgba(251, 251, 251, 0.15);'></div>
                            </div>
                            </a>
                        </div>
                        <div class='card-body'>
                            <a href='' class='text-reset'>
                            <h5 class='card-title mb-3'>". $row['name'] ."</h5>
                            </a>
                        </div>
                        </div>
                    </div>
                    ";
                }
            ?>
        </div>
    </div>
    </section>
</body>
</html>