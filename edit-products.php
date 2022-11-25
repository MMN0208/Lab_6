<?php
    session_start();
    include "./processing/session.php";
    if($user_permission != 'admin') {
        header("Location: index.php?page=home");
    } else {
        include "./processing/products_processing.php";
        include "./processing/add-products_processing.php";
    }
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
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="ndex.php?page=add-products">Add Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php?page=logout">Logout</a>
                            </li> 
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="content">
            <section class="vh-100" style="background-color: #000;">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-md-10">
                            <?php
                            if(isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $product = getByID($id);

                                if(mysqli_num_rows($product) > 0) {
                                    $data = mysqli_fetch_array($product);
                                    ?>
                                    <div class="card">
                                        <div class="card-header">
                                            <h2>Edit Product <?php echo $processing_check ?></h2>
                                        </div>
                                        <div class="card-body p-5">
                                            <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="row d-flex justify-content-center align-items-center">
                                                <div class="col-md-5 mb-4">
                                                    <input type="hidden" name="product_id" value="<?= $data['id'] ?>">
                                                    <label for="">Name</label>
                                                    <input type="text" name="name" value="<?= $data['name']; ?>" placeholder="Enter Product Name" class="form-control">
                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <label for="">Upload Image</label>
                                                    <input type="file" name="image" class="form-control">
                                                    <input type="hidden" name="old_image" value="<?= $data['image']; ?>">
                                                </div>
                                                <div class="col-md-1 mb-4">
                                                    <label for="">Current Image</label>
                                                    <img src="./uploads/<?= $data['image'] ?>" width="40px" height="40px">
                                                </div>
                                                <div class="col-md-10 mb-4 mr-4">
                                                    <label for="">Description</label>
                                                    <input type="text" name="description" value="<?= $data['description']; ?>" placeholder="Enter Product Description" class="form-control">
                                                </div>
                                                <div class="col-md-5 mb-5">
                                                    <label for="">Category</label>
                                                    <select name="category" class="form-select form-control">
                                                        <?php
                                                            if($data['category'] == 'iPhone') {
                                                                ?>
                                                                <option value="iPhone" selected>iPhone</option>
                                                                <option value="iPad">iPad</option>
                                                                <option value="Mac">Mac</option>
                                                                <?php
                                                            } elseif($data['category'] == 'iPad') {
                                                                ?>
                                                                <option value="iPhone">iPhone</option>
                                                                <option value="iPad" selected>iPad</option>
                                                                <option value="Mac">Mac</option>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <option value="iPhone">iPhone</option>
                                                                <option value="iPad">iPad</option>
                                                                <option value="Mac" selected>Mac</option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-5 mb-5">
                                                    <label for="">Price</label>
                                                    <input type="number" step="0.01" name="price" value="<?= $data['price']; ?>" placeholder="Enter Product Price" class="form-control">
                                                </div>
                                                <div class="col-md-12 d-flex justify-content-center">
                                                    <button type="submit" name="update_product" class="btn btn-dark btn-lg btn-block">Update</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    echo "Product not found";
                                }
                            } else {
                                echo "ID missing from URL";
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