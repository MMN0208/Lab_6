<?php
    include "./processing/config.php";

    function getAll() {
        global $conn;
        $sql = "SELECT * FROM products ORDER BY id";
        $query = mysqli_query($conn, $sql);
        return $query;
    }

    function getByID($id) {
        global $conn;
        $sql = "SELECT * FROM products WHERE id = '$id'";
        $query = mysqli_query($conn, $sql);
        return $query;
    }

    function getBySearch($keyword) {
        global $conn;
        $sql = "SELECT * FROM products WHERE name LIKE '%$keyword%' OR category LIKE '%$keyword%'";
        if($keyword == '') {
            $sql .= "ORDER BY id";
        } else {
            $sql .= "ORDER BY price";
        }
        $query = mysqli_query($conn, $sql);
        return $query;
    }
?>