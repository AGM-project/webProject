<?php

include '../include/connect.php';
$id = $_POST['id_makanan'];
$tipe = $_POST['tipe'];
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];
$gambar = addslashes(file_get_contents($_FILES['gambar']['tmp_name']));
if (isset($_POST['status'])){$status = 1;} else {$status = 0;}

if (!empty($_FILES['gambar']['tmp_name'])) 
{
    $sql = "UPDATE food SET tipe ='$tipe' , nama='$nama', deskripsi='$deskripsi', harga='$harga', gambar='$gambar', status='$status' WHERE id_makanan='$id'"; 

        $hasil=$con->query($sql);
}
else
{
    $sql = "UPDATE food SET tipe ='$tipe' , nama='$nama', deskripsi='$deskripsi', harga='$harga', status='$status' WHERE id_makanan='$id'"; 

        $hasil=$con->query($sql);
}

if($hasil){
    echo"<script>alert('Produk Berhasil Diedit!');location.href='../beverages.php';</script>";
} else
    echo"<script>alert('Terjadi Kesalahan!');location.href='../beverages.php';</script>";
?>