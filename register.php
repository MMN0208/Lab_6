<?php
    session_start();
    if(isset($_SESSION["sess_user"])) {
        header("Location: index.php?page=home");
    } else {
        include './processing/register_processing.php';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab_5: Sign up & sign in exercise</title>
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
                                <a class="nav-link" aria-current="page" href="index.php?page=login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Register</a>
                            </li> 
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div id="content" class="mt-4">
            <section class="vh-100" style="background-color: #000;">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">

                                    <h3 class="mb-5">Create account</h3>

                                    <p class="h4 mb-5">
                                        <?php
                                            echo $register_error;
                                        ?>
                                    </p>

                                    <form action="" method="post">
                                    <div class="form-floating mb-5">
                                        <input type="text" name="user" required class="form-control form-control-lg" id="floatingInput" placeholder="Username">
                                        <label for="floatingInput">Username</label>
                                    </div>

                                    <div class="form-floating mb-5">
                                        <input type="password" name="pass1" required class="form-control form-control-lg" id="floatingPassword" placeholder="Password">
                                        <label for="floatingPassword">Password</label>
                                    </div>

                                    <div class="form-floating mb-5">
                                        <input type="password" name="pass2" required class="form-control form-control-lg" id="floatingPassword" placeholder="Password">
                                        <label for="floatingPassword">Confirm password</label>
                                    </div>
                        
                                    <button class="btn btn-dark btn-lg btn-block" type="submit" name="register">Sign up</button>
                                    </form>

                                </div>
                            </div>
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