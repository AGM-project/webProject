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
                                                <a href="dashboard.php">Beranda</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item">Contact Us</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-16 m-t-20">
                            <div class="card-body">
										<div class="default-tab">
											<nav>
												<div class="nav nav-tabs" id="nav-tab" role="tablist">
													<a class="nav-item nav-link active" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact"
													 aria-selected="false">Contact</a>
													<a class="nav-item nav-link" id="nav-map-tab" data-toggle="tab" href="#nav-map" role="tab" aria-controls="nav-map"
													 aria-selected="false">Map</a>
												</div>
											</nav>
											<div class="tab-content pl-3 pt-2" id="nav-tabContent">
												<div class="tab-pane fade show active" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                                    <p>- Handphone : +62 857-7492-2937<br>
                                                       - Whatsapp : <a href="https://wa.me/+6285774922937">085774922937</a><br>
                                                       - Instagram : <a href="https://www.instagram.com/tixz_kitchen/">tixz_kitchen</a><br>
                                                    </p>
												</div>
                                                
												<div class="tab-pane fade" id="nav-map" role="tabpanel" aria-labelledby="nav-map-tab">
													<p> Perumahan Duta Bumi 3 Jl.Duta Permai XI Blok R no.32 | Kelurahan : Pejuang , Kecamatan : Medan Satria | Kota Bekasi</p><br>
                                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.5381927019735!2d106.98653416413734!3d-6.19248761239164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698bea1e97999b%3A0x7f20fb4d77ea08a5!2sRT.003%2FRW.033%2C%20Pejuang%2C%20Kecamatan%20Medan%20Satria%2C%20Kota%20Bks%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1610020381495!5m2!1sid!2sid" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                                                </div>
											</div>

										</div>
									</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
