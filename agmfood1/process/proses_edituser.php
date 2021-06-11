<?php

include '../include/connect.php';
$id = $_POST['id_user'];
$nama = $_POST['nama'];
$gender = $_POST['gender'];
$date = date("Y-m-d", strtotime($_POST['tgl_lahir']));
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$password = md5($_POST['password']);  
$role = $_POST['role'];

$foto = addslashes(file_get_contents($_FILES['gambar']['tmp_name']));

if (!empty($_FILES['gambar']['tmp_name'])) 
{
    if (!empty($_POST['password'])){
        $sql = "UPDATE user SET nama='$nama', gender='$gender', tgl_lahir='$date',alamat='$alamat', gambar='$foto', email='$email', password='$password', role='$role' WHERE id_user='$id'"; 

        $hasil=$con->query($sql);
    } else{
        $sql = "UPDATE user SET nama='$nama', gender='$gender', tgl_lahir='$date',alamat='$alamat', gambar='$foto', email='$email', role='$role' WHERE id_user='$id'"; 

        $hasil=$con->query($sql);
    }
}
else
{
    if (!empty($_POST['password'])){
    $sql = "UPDATE user SET nama='$nama', gender='$gender', tgl_lahir='$date',alamat='$alamat', email='$email', password='$password', role='$role' WHERE id_user='$id'"; 

        $hasil=$con->query($sql);
    } else{
        $sql = "UPDATE user SET nama='$nama', gender='$gender', tgl_lahir='$date',alamat='$alamat', email='$email', role='$role' WHERE id_user='$id'"; 

        $hasil=$con->query($sql);
    }
}
if($hasil){
    echo"<script>alert('Data Berhasil Diedit!');location.href='../userdata.php';</script>";
} else
    echo"<script>alert('Terjadi Kesalahan!');location.href='../userdata.php';</script>";
?>