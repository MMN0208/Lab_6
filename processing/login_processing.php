<?php 
include "./processing/config.php";

if(isset($_POST["login"])) { 
    $user = mysqli_real_escape_string($conn, $_POST['user']);  
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);  
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$user' and password = '$pass'");  
    $numrows = mysqli_num_rows($query);

    if($numrows == 1) {
        $row = mysqli_fetch_assoc($query);  
        $dbusername = $row['username'];
        $dbpassword = $row['password'];

        if($user == $dbusername && $pass == $dbpassword) {
            $_SESSION['sess_user'] = $user;

            header("Location: index.php?page=home");
        }
    } else {  
        $login_error = "Invalid username or password!";  
    }
}
?>