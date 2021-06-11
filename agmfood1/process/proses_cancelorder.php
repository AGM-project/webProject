<?php

include '../include/connect.php';
$id = $_GET['id'];
$cancel22 = 'Cancelled';
$sql = "UPDATE orders SET status='$cancel22' WHERE id='$id'"; 
$hasil=$con->query($sql);

if($hasil){
    echo"<script>alert('Order Cancelled!');location.href='../statusorder.php?id=".$_SESSION['user_id']."';</script>";
} else
    echo"<script>alert('Terjadi Kesalahan!');location.href='../statusorder.php?id=".$_SESSION['user_id']."';</script>";
?>