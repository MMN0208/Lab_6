<?php
    session_start();
    include "./processing/session.php";
    include "./processing/products_processing.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab_6: Working with database</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        <?php include "./assets/css/style.css" ?>
    </style>
</head>
<body>
    <div id="main">
        <div id="header">
            <nav id="nav" class="navbar navbar-expand-lg navbar-dark py-2">
                <div class="container-fluid">
                    <a class="store-name navbar-brand" href="index.php?page=home">MMN Store</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php?page=home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php?page=products">Products</a>
                            </li>
                            <?php
                                if(!$logged_in) {
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="index.php?page=login">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="index.php?page=register">Register</a>
                                    </li>
                                    <?php
                                } else {
                                    if($user_permission == 'admin') {
                                        ?>
                                        <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="index.php?page=add-products">Add Products</a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="index.php?page=logout">Logout</a>
                                    </li>
                                    <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div id="content" class="mt-5">
            <section class="vh-100" style="background-color: #000;">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-md-11 col-sm-10 col-9">
                            <?php
                            if(isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $product = getByID($id);

                                if(mysqli_num_rows($product) > 0) {
                                    $data = mysqli_fetch_array($product);
                                    ?>
                                    <div class="card">
                                        <div class="card-body p-4">
                                            <div class="container">
                                                <div class="row d-flex justify-content-around">
                                                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                                                        <img src="uploads/<?= $data['image']; ?>" alt="Product image" class="w-100 product-img">
                                                    </div>

                                                    <div class="mt-5 col-md-6">
                                                        <h2><?= $data['name']; ?></h2>
                                                        <hr>
                                                        <h3>
                                                            Product line<br>
                                                        </h3>
                                                        <p class="mt-3 product-specification">
                                                            <?= $data['category']; ?>
                                                        </p>
                                                        <hr>
                                                        <h3>
                                                            Specification<br>
                                                        </h3>
                                                        <p class="mt-3 product-specification">
                                                            <?= $data['description']; ?>
                                                        </p>
                                                        <hr>
                                                        <h3>
                                                            Price<br>
                                                        </h3>
                                                        <div class="row mt-3 d-flex align-items-center">
                                                            <div class="col-md-6">
                                                                <p class="h2">$<?= $data['price']; ?></p>
                                                            </div>
                                                            <?php
                                                                if($user_permission != 'admin') {
                                                                    ?>
                                                                    <div class="col-md-6 d-flex justify-content-center">
                                                                        <a href="#" class="btn btn-dark buy-btn">Buy</a>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <h2 class="text-white">Product not found</h2>
                                    <?php
                                }
                            } else {
                                ?>
                                <h2 class="text-white">ID missing from URL</h2>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include "./include/footer.php" ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>