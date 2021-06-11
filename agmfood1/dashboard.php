<?php

include 'include/connect.php';

if($_SESSION['admin_sid']==session_id() or $_SESSION['customer_sid']==session_id())
		{?>
<!DOCTYPE html>
<html lang="en">

<?php include("include/head.php");?>

<body class="animsition">
    <div class="page-wrapper">
        
        <!-- MENU SIDEBAR-->
        <?php include("include/sidebar.php");?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <?php include("include/header.php");?>    
            <!-- END HEADER DESKTOP-->

            <!-- BREADCRUMB-->
            <section class="au-breadcrumb m-t-75">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="au-breadcrumb-content">
                                    <div class="au-breadcrumb-left">
                                        <span class="au-breadcrumb-span">Kamu ada di:</span>
                                        <ul class="list-unstyled list-inline au-breadcrumb__list">
                                            <li class="list-inline-item active">
                                                <li class="list-inline-item">Beranda</li>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item">Dashboard</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <!-- STATISTIC-->
            <section class="statistic">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                                <div class="col-md-6 col-lg-12 m-b-30">
                                        <div class="input-group-addon" id="tanggalnow"></div>
                                </div>
                            
                            <?php
                            if($_SESSION['admin_sid']==session_id())
		                    {?>

                            <div class="col-md-6 col-lg-3">
                                    <div class="statistic__item">
                                    <a href="userdata.php">
                                        <?php
                                        $data_user = mysqli_query($con,"SELECT * FROM user");
                                        $jumlah_user = mysqli_num_rows($data_user);
                                        ?>
                                        <h2 class="number"><?php echo $jumlah_user;?></h2>
                                            <span class="desc">Users</span>
                                        <div class="icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </a>
                                    </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                <a href="foodmenu.php">
                                <?php
                                $data_makanan = mysqli_query($con,"SELECT * FROM food WHERE tipe='makanan'");
                                $jumlah_makanan = mysqli_num_rows($data_makanan);
                                ?>
                                    <h2 class="number"><?php echo $jumlah_makanan;?></h2>
                                    <span class="desc">Makanan</span>
                                    <div class="icon">
                                        <i class="fas fa-utensils"></i>
                                    </div>
                                </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                <a href="beverages.php">
                                <?php
                                $data_minuman = mysqli_query($con,"SELECT * FROM food WHERE tipe='minuman'");
                                $jumlah_minuman = mysqli_num_rows($data_minuman);
                                ?>
                                    <h2 class="number"><?php echo $jumlah_minuman;?></h2>
                                    <span class="desc">Minuman</span>
                                    <div class="icon">
                                        <i class="fas fa-beer"></i>
                                    </div>
                                </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                <a href="statusorder.php">
                                <?php
                                $data_order = mysqli_query($con,"SELECT * FROM orders WHERE status != 'Cancelled'");
                                $jumlah_order = mysqli_num_rows($data_order);
                                ?>
                                    <h2 class="number"><?php echo $jumlah_order;?></h2>
                                    <span class="desc">Total Orders</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-book"></i>
                                    </div>
                                </a>
                                </div>
                            </div>
                            <?php } ?>
                            <?php
                            if($_SESSION['customer_sid']==session_id())
		                    {?>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                <a href="statusorder.php?id=<?php echo $_SESSION['user_id']; ?>">
                                <?php
                                $data_order = mysqli_query($con,"SELECT o.id, c.id FROM orders as o LEFT JOIN customers as c ON o.customer_id = c.id WHERE c.login_id = '$user_id'");
                                $jumlah_order = mysqli_num_rows($data_order);
                                ?>
                                    <h2 class="number"><?php echo $jumlah_order;?></h2>
                                    <span class="desc">Total Orders</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-book"></i>
                                    </div>
                                </a>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
    <?php include("include/js.php"); ?>
</body>

</html>
<?php
    }
    else{
        header("location:login.php");
    }
?>
<!-- end document-->
