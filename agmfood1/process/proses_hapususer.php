<?php
include '../include/connect.php';
$id = $_GET['id'];
$sqlhapus = "DELETE FROM user WHERE id_user='$id'";  
        $hasilhapus=$con->query($sqlhapus);

if($hasilhapus === TRUE){
    echo"<script>alert('Data Berhasil Dihapus!');location.href='../userdata.php';</script>";
} else
    echo"<script>alert('Terjadi Kesalahan!');location.href='../userdata.php';</script>";
?>