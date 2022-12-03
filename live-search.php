<?php
    include "./processing/config.php";
    
    if(isset($_POST["search"])) {
        $data = array();

        $keyword = $_POST["search"];
            
        $sql = "SELECT * FROM products WHERE name LIKE '%$keyword%' OR category LIKE '%$keyword%'";
        if($keyword == '') {
            $sql .= "ORDER BY id";
        } else {
            $sql .= "ORDER BY name";
        }
        $query = mysqli_query($conn, $sql);

        foreach($query as $row) {
            $data[] = array(
                'id'            => $row['id'],
                'category'      => $row['category'],
                'name'          => $row['name'],
                'image'         => $row['image'],
                'description'   => $row['description'],
                'price'         => $row['price']
            );
        }

        echo json_encode($data);
    }
?>