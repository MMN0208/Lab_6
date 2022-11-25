<?php
    session_start();
    include "./processing/session.php";
    if($user_permission != 'admin') {
        header("Location: index.php?page=home");
    } else {
        $getID = $_GET['id'];
        if(!empty($getID)) {
            $image_sql = "SELECT image FROM products where id='$getID'";
            $image_query = mysqli_query($conn, $image_sql);

            $image_row = mysqli_fetch_assoc($image_query);
            $image = $image_row['image'];
            
            if(file_exists("./uploads/".$image)) {
                unlink("./uploads/".$image);
            }

            $delete_sql = "DELETE FROM products where id='$getID'";
            $delete_query = mysqli_query($conn, $delete_sql);
        }

        header("Location: index.php?page=products");
    }
?>