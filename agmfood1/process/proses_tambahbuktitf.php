<?php

include '../include/connect.php';
$id = $_POST['id_order'];
$gambar = addslashes(file_get_contents($_FILES['gambar']['tmp_name']));

$sql = "UPDATE orders SET bukti_tf ='$gambar' WHERE id='$id'";  

        $hasil=$con->query($sql);

if($hasil){
    echo"<script>alert('Berhasil Upload!');location.href='../statusorder.php';</script>";
} else {
    echo"<script>alert('Terjadi Kesalahan Upload!');location.href='../statusorder.php';</script>";
}
?>