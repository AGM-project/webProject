<?php

include_once 'include/connect.php';
include_once 'cart.class.php';
$cart = new Cart;

if($_SESSION['admin_sid']==session_id() or $_SESSION['customer_sid']==session_id())
		{
?>

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
                                            <li class="list-inline-item">Beli produk</li>
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
                            <div class="col">
                                <a href="viewCart.php" title="View Cart">
                                <button type="button" class="btn btn-primary btn-lg">
                                            <i class="fas fa-shopping-cart m-r-10"></i>Keranjang
                                            <span class="badge badge-danger m-l-10">(<?php echo ($cart->total_items() > 0)?$cart->total_items().' Items':'Empty'; ?>)</span>
							    </button>
                                </a>
                                <hr>
                            </div>
                        </div>
                    </div>
                    </div>
                            <div class="col-lg-16 m-t-20">
                                <div class="card-body">
                                    <div class="default-tab">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <!-- <a class="nav-item nav-link" id="nav-rekomendasi-tab" data-toggle="tab" href="#nav-rekomendasi" role="tab" aria-controls="nav-rekomendasi"
                                                aria-selected="false"><strong>Rekomendasi</strong></a> -->
                                                <a class="nav-item nav-link active" id="nav-makanan-tab" data-toggle="tab" href="#nav-makanan" role="tab" aria-controls="nav-makanan"
                                                aria-selected="false">Makanan</a>
                                                <a class="nav-item nav-link" id="nav-minuman-tab" data-toggle="tab" href="#nav-minuman" role="tab" aria-controls="nav-minuman"
                                                aria-selected="false">Minuman</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                            <div class="tab-pane fade" id="nav-rekomendasi" role="tabpanel" aria-labelledby="nav-rekomendasi-tab">
                                            <div class="row">
                                            <?php
                                                $result3 = $con->query("SELECT p.order_id, t.product_id, sum(p.quantity), f.* FROM order_items p LEFT JOIN food f ON f.id_makanan = p.product_id JOIN (SELECT a.* FROM order_items a LEFT JOIN order_items b ON a.order_id = b.order_id AND a.quantity < b.quantity WHERE b.quantity is NULL) t ON t.order_id = p.order_id GROUP BY p.product_id ORDER BY sum(p.quantity) DESC LIMIT 3"); 
                                                if($result3->num_rows > 0){  
                                                    while($row3 = $result3->fetch_assoc())
                                                    { 
                                                ?>
                                                <div class="col-md-2 col-lg-3">
                                                    <div class="card m-t-20">
                                                    <img class="card-img-top mx-auto d-block" src="data:image/jpeg;base64,<?php echo base64_encode($row3["gambar"]);?>" alt="Card image cap" style="width:220px;height:200px; object-fit: cover;">
                                                        <div class="card-body">
                                                            <div class="mx-auto d-block">
                                                                <h4 class="text-sm-center mt-2 mb-1"><?php echo $row3['nama'];?></h4>
                                                                <div class="text-sm-center">
                                                                    <small style="display: block;
                                                                    display: -webkit-box;
                                                                    line-height: 2;
                                                                    -webkit-line-clamp: 2;
                                                                    -webkit-box-orient: vertical;
                                                                    overflow: hidden;
                                                                    text-overflow: ellipsis;">
                                                                        <?php echo $row3['deskripsi'];?>
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <div class="card-footer">
                                                        <strong class="card-title mb-3">Rp.&nbsp;&nbsp;<?php echo number_format($row3["harga"], 0, ".", ".");?></strong>
                                                    </div>
                                                    <div class="text-sm-center">
                                                        <div class="option">
                                                            <a href="cartAction.php?action=addToCart&id=<?php echo $row3["id_makanan"]; ?>">
                                                                <button type="button" class="btn btn-primary btn-sm btn-block m-2">
                                                                    <i class="fa fa-plus"></i>&nbsp; Beli ini
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <?php
                                                }
                                            }else{echo'<p>Product(s) not found.....</p>';}
                                                ?>
                                            </div>
                                            </div>
                                            <div class="tab-pane fade show active" id="nav-makanan" role="tabpanel" aria-labelledby="nav-makanan-tab">
                                            <div class="row">
                                                <?php
                                                $result = $con->query("SELECT * FROM food WHERE tipe='makanan' AND status='1' ORDER BY nama"); 
                                                if($result->num_rows > 0){  
                                                    while($row = $result->fetch_assoc())
                                                    { 
                                                ?>
                                                <div class="col-md-2 col-lg-3">
                                                    <div class="card m-t-20">
                                                    <img class="card-img-top mx-auto d-block" src="data:image/jpeg;base64,<?php echo base64_encode($row["gambar"]);?>" alt="Card image cap" style="width:220px;height:200px; object-fit: cover;">
                                                        <div class="card-body">
                                                            <div class="mx-auto d-block">
                                                                <h4 class="text-sm-center mt-2 mb-1"><?php echo $row['nama'];?></h4>
                                                                <div class="text-sm-center">
                                                                    <small style="display: block;
                                                                    display: -webkit-box;
                                                                    line-height: 2;
                                                                    -webkit-line-clamp: 2;
                                                                    -webkit-box-orient: vertical;
                                                                    overflow: hidden;
                                                                    text-overflow: ellipsis;">
                                                                        <?php echo $row['deskripsi'];?>
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <div class="card-footer">
                                                        <strong class="card-title mb-3">Rp.&nbsp;&nbsp;<?php echo number_format($row["harga"], 0, ".", ".");?></strong>
                                                    </div>
                                                    <div class="text-sm-center">
                                                        <div class="option">
                                                            <a href="cartAction.php?action=addToCart&id=<?php echo $row["id_makanan"]; ?>">
                                                                <button type="button" class="btn btn-primary btn-sm btn-block m-2">
                                                                    <i class="fa fa-plus"></i>&nbsp; Beli ini
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <?php
                                                }
                                            }else{echo'<p>Product(s) not found.....</p>';}
                                                ?>
                                            </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav-minuman" role="tabpanel" aria-labelledby="nav-minuman-tab">
                                            <div class="row">
                                                <?php
                                                $result2 = $con->query("SELECT * FROM food WHERE tipe='minuman' AND status='1' ORDER BY nama"); 
                                                if($result2->num_rows > 0){  
                                                    while($row2 = $result2->fetch_assoc())
                                                    { 
                                                ?>
                                                <div class="col-md-2 col-lg-3">
                                                    <div class="card m-t-20">
                                                    <img class="card-img-top mx-auto d-block" src="data:image/jpeg;base64,<?php echo base64_encode($row2["gambar"]);?>" alt="Card image cap" style="width:220px;height:200px; object-fit: cover;">
                                                        <div class="card-body">
                                                            <div class="mx-auto d-block">
                                                                <h4 class="text-sm-center mt-2 mb-1"><?php echo $row2['nama'];?></h4>
                                                                <div class="text-sm-center">
                                                                    <small style="display: block;
                                                                    display: -webkit-box;
                                                                    line-height: 2;
                                                                    -webkit-line-clamp: 2;
                                                                    -webkit-box-orient: vertical;
                                                                    overflow: hidden;
                                                                    text-overflow: ellipsis;">
                                                                        <?php echo $row2['deskripsi'];?>
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <div class="card-footer">
                                                        <strong class="card-title mb-3">Rp.&nbsp;&nbsp;<?php echo number_format($row2["harga"], 0, ".", ".");?></strong>
                                                    </div>
                                                    <div class="text-sm-center">
                                                        <div class="option">
                                                            <a href="cartAction.php?action=addToCart&id=<?php echo $row2["id_makanan"]; ?>">
                                                                <button type="button" class="btn btn-primary btn-sm m-2">
                                                                    <i class="fa fa-plus"></i>&nbsp; Beli ini
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <?php
                                                }
                                            }else{echo'<p>Product(s) not found.....</p>';}
                                                ?>
                                            </div>
                                            </div>
										</div>
                                    <a class="btn btn-sm btn-dark offset col-sm-12" href="#nav-tab">Back to top</a>
									</div>
								</div>
                            </div>      
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
    } else if($_SESSION['customer_sid']==session_id()){header("location:dashboard.php");}
    else{
        header("location:login.php");
    }
?>
<!-- end document-->