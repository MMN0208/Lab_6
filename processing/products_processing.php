<?php
    include "./processing/config.php";

    function getAll() {
        global $conn;
        $sql = "SELECT * FROM products";
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
        $query = mysqli_query($conn, $sql);
        return $query;
    }
?>