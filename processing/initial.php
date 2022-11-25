<?php

$hostname = "localhost";
$username = "mmn";
$password = "mmn0208";
$database = "lab_6";

$conn = mysqli_connect($hostname, $username, $password) or die("MySQL connection failed");

$sql = "CREATE DATABASE IF NOT EXISTS " . $database . "";
if (mysqli_query($conn, $sql)) {
  echo "Database created successfully<br>";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}

mysqli_close($conn);

$conn = mysqli_connect($hostname, $username, $password, $database) or die("Database connection failed");

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(200) NOT NULL,
    password VARCHAR(200) NOT NULL,
    level VARCHAR(200) NOT NULL
    )";

if (mysqli_query($conn, $sql)) {
    echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

$sql = "CREATE TABLE IF NOT EXISTS products (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(200) NOT NULL,
    description VARCHAR(200) NOT NULL,
    category VARCHAR(200) NOT NULL,
    price DOUBLE NOT NULL,
    image VARCHAR(200) NOT NULL
    )";

if (mysqli_query($conn, $sql)) {
    echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

$sql = "SELECT * FROM users where username = 'admin'";
$query = mysqli_query($conn, $sql);
$numrows = mysqli_num_rows($query);

if(!$numrows) {
    $sql = "INSERT INTO users (username, password, level) 
    VALUES ('admin', 'admin', 'admin')";

    if (mysqli_query($conn, $sql)) {
        echo "Admin account created successfully<br>";
    } else {
        echo "Error creating admin account: " . mysqli_error($conn);
    }
}

?>