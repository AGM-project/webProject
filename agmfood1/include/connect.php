<?php
$servername = "localhost";
$server_user = "root";
$server_pass = "";
$dbname = "agmfood";

error_reporting(E_ERROR | E_PARSE);
session_start();
$name = $_SESSION['nama'];
$role = $_SESSION['role'];
$foto = $_SESSION['gambar'];
$user_id = $_SESSION['user_id'];

$con = new mysqli($servername, $server_user, $server_pass, $dbname);
 
// Check connection 
if ($con->connect_error) { 
    die("Connection failed: " . $con->connect_error); 
}
?>