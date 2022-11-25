<?php
    include "./processing/config.php";

    if(isset($_POST["add_product"])) {
        $name = $_POST["name"];
        $description = $_POST["description"];
        $category = $_POST["category"];
        $price = $_POST["price"];

        $image = $_FILES["image"]["name"];

        $path = "./uploads";

        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_ext;

        $product_query = "INSERT INTO products (name, description, category, price, image)
                      VALUES ('$name', '$description', '$category', '$price', '$filename')";

        $product_sql = mysqli_query($conn, $product_query);

        if($product_sql) {
            move_uploaded_file($_FILES["image"]["tmp_name"], $path.'/'.$filename);
            $processing_check = "Successful";
        } else {
            $processing_check = "Failed";
        }
    } elseif(isset($_POST["update_product"])) {
        $product_id = $_POST["product_id"];
        $name = $_POST["name"];
        $description = $_POST["description"];
        $category = $_POST["category"];
        $price = $_POST["price"];

        $new_image = $_FILES["image"]["name"];
        $old_image = $_POST["old_image"];

        $path = "./uploads";

        if($new_image != "") {
            $update_filename = $new_image;
        } else {
            $update_filename = $old_image;
        }

        $update_query = "UPDATE products SET name='$name', description='$description',
                     category='$category', price='$price', image='$update_filename'
                     WHERE id='$product_id'";

        $update_sql = mysqli_query($conn, $update_query);

        if($update_sql) {
            if($_FILES["image"]["name"] != "") {
                move_uploaded_file($_FILES["image"]["tmp_name"], $path.'/'.$new_image);
                if(file_exists("./uploads/".$old_image)) {
                    unlink("./uploads/".$old_image);
                }
            }
            $processing_check = "Successful";
        } else {
            $processing_check = "Failed";
        }
    }
?>