<?php
include 'include/connect.php';

	if($_SESSION['customer_sid']==session_id())
	{
		header("location:dashboard.php");
	}
	else
	{
		if($_SESSION['admin_sid']==session_id())
		{
			header("location:dashboard.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>