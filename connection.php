<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "authentication";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn) {
    echo "Database connected";
} ?>