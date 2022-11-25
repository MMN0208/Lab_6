<?php
    include "./processing/config.php";

    if(!isset($_SESSION['sess_user'])) {
        $login_session = 'guest';
        $user_permission = 'customer';
        $logged_in = false;
    } else {
        $user_check = $_SESSION['sess_user'];
    
        $ses_sql = mysqli_query($conn, "SELECT username, level FROM users WHERE username = '$user_check'");
        $row = mysqli_fetch_assoc($ses_sql);
    
        $login_session = $row['username'];
        $user_permission = $row['level'];   
        $logged_in = true;
    }

?>