<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_livres_bib";

$connect = mysqli_connect($servername, $username, $password, $dbname);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($connect, "utf8");

