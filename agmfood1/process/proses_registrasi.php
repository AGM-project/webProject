<?php
include '../include/connect.php';
$nama = $_POST['nama'];
$gender = $_POST['gender'];
$date = date("Y-m-d", strtotime($_POST['tgl_lahir']));
$alamat = $_POST['alamat'];
$foto = addslashes(file_get_contents($_FILES['gambar']['tmp_name']));
$email = $_POST['email'];
$password = md5($_POST['password']);  
$role = $_POST['role'];

$sql = "INSERT INTO user (nama, gender, tgl_lahir, alamat, gambar, email, password, role)
    VALUES 
    ('$nama', '$gender', '$date', '$alamat', '$foto', '$email', '$password', '$role');";
    
    $hasil=$con->query($sql);

if($hasil){
    echo"<script>alert('Berhasil Registrasi!');location.href='../login.php';</script>";
} else
    echo"<script>alert('Gagal Registrasi!');location.href='../register.php';</script>";
?>