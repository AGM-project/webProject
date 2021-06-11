<?php

include '../include/connect.php';
$id = $_GET['id'];
$statusnya = $_POST['statusnya'];
$sql = "UPDATE orders SET status='$statusnya' WHERE id='$id'"; 
$hasil=$con->query($sql);

if($hasil){
    echo"<script>alert('Order Updated!');location.href='../statusorder.php';</script>";
} else
    echo"<script>alert('Terjadi Kesalahan!');location.href='../statusorder.php';</script>";
?>