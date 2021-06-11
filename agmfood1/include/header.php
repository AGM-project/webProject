<?php include 'include/connect.php';
?>

<header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none m-t-40">
                                <a href="dashboard.php">
                                    <img src="images/logo.png" alt="logo" style="height:50%;width:50%;"/>
                                </a>
                            </div>
                            <div class="header-button2 m-t-40">
                                <div class="header-button-item mr-0 js-sidebar-btn">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                                <div class="setting-menu js-right-sidebar d-none d-lg-block m-t-40">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a class="nav-link" href="setelanakun.php?id=<?php echo $_SESSION['user_id']; ?>">
                                                <i class="zmdi zmdi-settings"></i>Setelan Akun</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a class="nav-link" href="process/proses_logout.php">
                                                <i class="fas fa-sign-out-alt"></i>Sign Out</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                <div class="logo">                   
                        <img src="images/logo.png" alt="AGAM" />
                </div>
                <div class="menu-sidebar2__content js-scrollbar2">
                    <div class="account2">
                        <div class="image img-cir img-120">
                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($foto).'"/>';?>
                        </div>
                        <h4 class="name"><?php echo $name;?></h4>
                        <h6 class="pb-2 pt-1 display-5"><i><?php echo $role;?></i></h6>
                    </div>
                    <nav class="navbar-sidebar2 p-b-60">
                        <ul class="list-unstyled navbar__list">
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php">
                                    <i class="fas fa-tachometer-alt"></i>Dashboard
                                </a>
                            </li>
                            <?php if($_SESSION['admin_sid']==session_id())
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
                            <?php if($_SESSION['admin_sid']==session_id())
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
                            <a class="nav-link" href="process/proses_logout.php">
                                <i class="fas fa-sign-out-alt"></i>Sign Out</a>
                        </li>
                        </ul>
                    </nav>
                </div>
            </aside>