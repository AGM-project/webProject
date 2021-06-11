<?php include 'include/connect.php';

?>

<aside class="menu-sidebar2">
            <div class="logo">
                <a href="dashboard.php">
                    <img src="images/logo.png" alt="logo" />
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                <div class="account2">
                    <div class="image img-cir img-120">
                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($foto).'"/>';?>
                    </div>
                    <h3 class="name"><?php echo $name;?></h3>
                    <h6 class="pt-1 display-5"><i><?php echo $role;?></i></h6>
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <?php if($role == "Administrator")
                            {
                        ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="foodmenu.php">
                                        <i class="fas fa-utensils"></i>Menu Makanan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="beverages.php">
                                        <i class="fas fa-beer"></i>Menu Minuman</a>
                                </li>
                        <?php
                            }
                        ?>

                            <?php if($_SESSION['customer_sid']==session_id())
                            {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="orderfood.php">
                                        <i class="fas fa-tag"></i>Beli produk</a>
                                </li>
                            <?php
                            }
                            ?>
                            <?php if($_SESSION['customer_sid']==session_id())
                            {
                            ?>
                        <li class="nav-item">
                                <a class="nav-link" href="statusorder.php?id=<?php echo $_SESSION['user_id']; ?>">
                                    <i class="zmdi zmdi-book"></i>Riwayat Pemesanan
                                </a>
                        </li>
                        <?php }else
                            {
                            ?>
                        <li class="nav-item">
                                <a class="nav-link" href="statusorder.php">
                                    <i class="zmdi zmdi-book"></i>Riwayat Pemesanan
                                </a>
                        </li>
                        <?php
                            }
                            ?>
                        <?php if($role == "Administrator")
                            {
                        ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="userdata.php">
                                        <i class="zmdi zmdi-account-calendar"></i>Data User</a>
                                </li>
                        <?php
                            }
                        ?>

                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">
                                <i class="fas fa-mobile"></i>Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="setelanakun.php?id=<?php echo $_SESSION['user_id']; ?>">
                                <i class="fas fa-gear"></i>Setelan Akun</a>
                        </li>
                        <li class="nav-item">
                        <a href="process/proses_logout.php">
                                <i class="fas fa-sign-out-alt"></i>Sign Out
                        </li>
                        </a>
                    </ul>
                </nav>
            </div>
        </aside>