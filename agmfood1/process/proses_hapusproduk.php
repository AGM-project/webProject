<?php
include '../include/connect.php';
$id = $_GET['id'];
$sql = "DELETE FROM food WHERE id_makanan='$id'";  
        $hasil=$con->query($sql);

if($hasil){
    echo"<script>alert('Produk Berhasil Dihapus!');location.href='../foodmenu.php';</script>";
} else
    echo"<script>alert('Terjadi Kesalahan!');location.href='../foodmenu.php';</script>";
?>