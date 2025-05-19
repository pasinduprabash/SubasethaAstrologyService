<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "astro";
$conn = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn){

    echo "";

} else {

    echo "Could not Connected";
}



?>