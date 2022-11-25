<?php
    session_start();
    include './processing/session.php';
    include './processing/products_processing.php';
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
    <div id="main" style="background-color: #000">
        <div id="header">
            <nav id="nav" class="navbar navbar-expand-lg navbar-dark py-2">
                <div class="container-fluid">
                    <a class="store-name navbar-brand" href="index.php?page=home">MMN Store</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php?page=home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Products</a>
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
                        <form class="d-flex" method="POST">
                            <input class="form-control me-2" name="keyword" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-light" name="product-search" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>

        <div id="content">
            <section class="vh-100" style="background-color: #000;">
                <div class="container py-5 h-100">
                    <div class="row d-flex align-items-center h-100">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2>Products</h2>
                                </div>
                                <div class="card-body p-5">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <?php
                                                    if($user_permission == 'admin') {
                                                        ?>
                                                        <th>Edit</th>
                                                        <th>Remove</th>
                                                        <?php
                                                    }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(isset($_POST["product-search"])) {
                                                    $keyword = $_POST["keyword"];
                                                    $product = getBySearch($keyword);
                                                } else {
                                                    $product = getAll();
                                                }

                                                if(mysqli_num_rows($product) > 0) {
                                                    foreach($product as $item) {
                                                        ?>
                                                        <tr>
                                                            <td> <?= $item['id']; ?></td>
                                                            <td> <?= $item['category']; ?></td>
                                                            <td> <?= $item['name']; ?></td>
                                                            <td>
                                                                <img src="./uploads/<?= $item['image']; ?>" width="50px" height="50px" alt="<?= $item['name']; ?>">
                                                            </td>
                                                            <td> <?= $item['description']; ?></td>
                                                            <td> $<?= $item['price']; ?></td>
                                                        <?php
                                                            if($user_permission == 'admin') {
                                                                ?>
                                                                <td>
                                                                    <a href="index.php?page=edit-products&id=<?= $item['id']; ?>" class="btn btn-dark">Edit</a>
                                                                </td>
                                                                <td>
                                                                    <a href="index.php?page=delete-products&id=<?= $item['id']; ?>" class="btn btn-dark">Remove</a>
                                                                </td>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                else {
                                                    echo "No records found";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>              
            </section>
        </div>

        <?php
            include './include/footer.php';
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>