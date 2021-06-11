<?php
include '../include/connect.php';
$tipe = $_POST['tipe'];
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];
$gambar = addslashes(file_get_contents($_FILES['gambar']['tmp_name']));
$status = $_POST['status'];

$sql = "INSERT INTO food (tipe, nama, deskripsi, harga, gambar, status)
    VALUES 
    ('$tipe', '$nama', '$deskripsi', '$harga', '$gambar', '$status');";  

        $hasil=$con->query($sql);

if($hasil){
    echo"<script>alert('Produk Berhasil Ditambah!');location.href='../beverages.php';</script>";
} else
    echo"<script>alert('Terjadi Kesalahan!');location.href='../beverages.php';</script>";
?>