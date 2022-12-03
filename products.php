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
                        <ul class="navbar-nav">
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
                    </div>
                </div>
            </nav>
        </div>

        <div id="content" class="mt-5">
            <section class="vh-100" style="background-color: #000;">
                <div class="container-md h-100">
                    <div class="row d-flex align-items-center h-100">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-6">
                                            <h2 class="m-0">Products</h2>
                                        </div>
                                        <div class="col-md-3 my-1 text-right">
                                            <b>
                                                Number of products: <span id="products-num"></span>
                                            </b>
                                        </div>
                                        <div class="col-md-3">
                                            <input class="form-control" name="search" type="text" placeholder="Search here" onkeyup="load_products(this.value);">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <table class="table table-bordered mb-0">
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
                                        <tbody id="products-list"></tbody>
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
    <script>
        load_products();

        function load_products(query = '') {
            var form_data = new FormData();
            form_data.append('search', query);

            var ajax_request = new XMLHttpRequest();
            ajax_request.open("POST", "live-search.php");
            ajax_request.send(form_data);

            ajax_request.onreadystatechange = function() {
                if(ajax_request.readyState == 4 && ajax_request.status == 200) {
                    var response = JSON.parse(ajax_request.responseText);

                    var html = '';

                    var user_permission = '<?php echo $user_permission; ?>';

                    for(var count = 0; count < response.length; count++) {
                        html += '<tr>';

                        html += '<td>' + response[count].id + '</td>';

                        html += '<td>' + response[count].category + '</td>';

                        html += '<td><a class="text-primary" href="index.php?page=product-view&id=' + response[count].id + '">' + response[count].name + '</a></td>';

                        html += '<td><img src="./uploads/' + response[count].image + '" width="50px" height="50px" alt="' + response[count].name + '"></td>';

                        html += '<td>' + response[count].description + '</td>';

                        html += '<td>$' + response[count].price + '</td>';

                        if(user_permission == 'admin') {
                            html += '<td><a href="index.php?page=edit-products&id=' + response[count].id + '" class="btn btn-dark">Edit</a></td>';
                            html += '<td><a href="index.php?page=delete-products&id=' + response[count].id + '" class="btn btn-dark">Remove</a></td>';
                        }

                        html += '</tr>';
                    }

                    if(count == 0) {
                        html = '<b>No records found.</b>';
                    }

                    document.getElementById('products-list').innerHTML = html;
                    document.getElementById('products-num').innerHTML = count;
                }
            }
        }
    </script>
</body>
</html>