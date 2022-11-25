<?php
    session_start();
    include './processing/session.php';
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
                    <a class="store-name navbar-brand" href="#">MMN Store</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
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

        <?php
            if($user_permission != 'admin') {
                ?>
                <div id="banner">
                    <div class="banner__text">
                        <h2 class="text__heading">Welcome <?php echo $login_session?></h2>
                        <div class="text__desc">
                            Find your suitable Apple products here
                        </div>
                    </div>
                    <div class="banner__img">
                    </div>
                </div>

                <div id="content">
                    <div id="contact-section">
                        <div class="content-section">
                            <div class="text__heading">Contact</div>
                            <div class="contact__info">
                                <div class="info__heading">Hotline</div>
                                <div class="info__desc">
                                    <a href="tel:1800420969">1800 420 969</a>
                                </div>
                                <div class="info__heading">Adresss</div>
                                <div class="info__desc">
                                    123 ABC Street, Ward 2,<br>
                                    DEF District, Polygon City
                                </div>
                                <div class="info__heading">Working hours</div>
                                <div class="info__desc">
                                    Monday to Saturday: 9am to 8pm<br>
                                    Sunday: 9am to 6pm
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div id="content">
                    <section class="vh-100" style="background-color: #000;">
                        <div class="container py-5 h-100">
                            <div class="row d-flex justify-content-around align-items-center h-100">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body p-4">
                                            <div class="row d-flex justify-content-around align-items-center text-center">
                                                <div class="col-md-4 border-end">
                                                    <i class="fa-solid fa-user dashboard-icon"></i>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <h2>Users</h2>
                                                    </div>
                                                    <div class="row">
                                                        <h2>
                                                            <?php
                                                                $users_query = mysqli_query($conn, "SELECT * FROM users");
                                                                $num_of_users = mysqli_num_rows($users_query);
                                                                echo $num_of_users;
                                                            ?>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body p-4">
                                            <div class="row d-flex justify-content-around align-items-center text-center">
                                                <div class="col-md-4 border-end">
                                                    <i class="fa-solid fa-mobile dashboard-icon"></i>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <h2>Products</h2>
                                                    </div>
                                                    <div class="row">
                                                        <h2>
                                                            <?php
                                                                $products_query = mysqli_query($conn, "SELECT * FROM products");
                                                                $num_of_products = mysqli_num_rows($products_query);
                                                                echo $num_of_products;
                                                            ?>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>              
                    </section>
                </div>
                <?php
            }
            include './include/footer.php';
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
