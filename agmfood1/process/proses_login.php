<?php
include '../include/connect.php';
$success=false;

$email = $_POST['email'];
$password = md5($_POST['password']);

$result = mysqli_query($con, "SELECT * FROM user WHERE email='$email' AND password='$password' AND role='Administrator' ;");
while($row = mysqli_fetch_array($result))
{
	$success = true;
	$user_id = $row['id_user'];
	$name = $row['nama'];
	$role= $row['role'];
	$foto= $row['gambar'];
}
if($success == true)
{	
	session_start();
	$_SESSION['admin_sid']=session_id();
	$_SESSION['user_id'] = $user_id;
	$_SESSION['role'] = $role;
	$_SESSION['nama'] = $name;
	$_SESSION['gambar'] = $foto;
	header("location: ../dashboard.php");
}
else
{
	$result = mysqli_query($con, "SELECT * FROM user WHERE email='$email' AND password='$password' AND role='Customer';");
	while($row = mysqli_fetch_array($result))
	{
	$success = true;
	$user_id = $row['id_user'];
	$name = $row['nama'];
	$role= $row['role'];
	$foto= $row['gambar'];
	}
	if($success == true)
	{
		session_start();
		$_SESSION['customer_sid']=session_id();
		$_SESSION['user_id'] = $user_id;
		$_SESSION['role'] = $role;
		$_SESSION['nama'] = $name;
		$_SESSION['gambar'] = $foto;	
		header("location: ../dashboard.php");
	}
	else
	{
		header("location: ../login.php");
	}
}
?>