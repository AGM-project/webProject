<?php

include 'include/connect.php';

if($_SESSION['admin_sid']==session_id())
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
                                            <li class="list-inline-item">Menu Minuman</li>
                                        </ul>
                                    </div>
                                    <!--trigger button modals-->
                                    <button type="button" class="au-btn au-btn-icon au-btn--green" data-toggle="modal" data-target="#staticModal">
                                            <i class="zmdi zmdi-plus"></i>add item
										</button>
                                        
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
                        <!-- <div class="row">
                            <div class="col">
                                <h2 class="mt-2 mb-1">
                                REKOMENDASI HARI INI!
                                </h2>
                                <hr>
                            </div>
                        </div> -->
                        <div class="row">
                         <?php
                            $sql = 'SELECT * FROM food WHERE tipe="minuman"';
                            $query = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($query))
                            {
                            ?>
                                    <div class="col-md-2 col-lg-3">
                                        <div class="card">
                                        <?php if($row['status']== 0){
                                            echo '<div class="text-center text-secondary bg-light">Not Available</div>';
                                            }else{
                                                echo '<div class="text-center text-white bg-success">Available</div>';
                                            }?>
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
                                                    <button type="button" class="btn btn-warning btn-sm m-2" data-toggle="modal" data-target="#staticModal-<?php echo $row['id_makanan']; ?>">
                                                        <i class="fa fa-edit"></i>&nbsp; Edit
                                                    </button>
                                                    <a href="process/proses_hapusproduk2.php?id=<?php echo $row['id_makanan']; ?>" onclick="return confirm('Yakin ingin hapus?');">
                                                        <button type="button" class="btn btn-danger btn-sm m-2">
                                                            <i class="fa fa-eraser"></i>&nbsp; Hapus
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            <?php
                            }
                            ?>
        
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->

            <!--tambah modal-->
            <div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
				                        <div class="modal-dialog modal-sm" role="document">
					                        <div class="modal-content">
						                        <div class="modal-header">
							                        <h4 class="modal-title" id="staticModalLabel">Tambah Minuman</h4>
							                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								                            <span aria-hidden="true">&times;</span>
							                        </button>
						                        </div>
						                    <div class="modal-body">
							                    <form action="process/proses_tambahproduk2.php" method="post" enctype="multipart/form-data">
                                                    <strong>Gambar Produk :</strong>
                                                    <div class="text-sm-center">
                                                    <input type="file" name="gambar" class="form-control border inputGambar" accept="image/*"
                                                    style="border:0; overflow: hidden;" required>
                                                    <img src="#" class="w-responsive mx-auto p-3 mt-2 mb-3 previewGambar" style="width:200px;height:100%;">
                                                    </div>
                                                    <strong>Nama Produk :</strong>
                                                    <div class="text-sm-center">
                                                        <input class="col border rounded mt-1" type="text" value="minuman" name="tipe" hidden> 
                                                        <input class="col border rounded mt-1" type="text" placeholder="nama.." name="nama" required>
                                                    </div>
                                                    <strong>Deskripsi Produk :</strong>
                                                    <div class="text-sm-center">
                                                        <textarea class="col border rounded mt-1" rows="2" placeholder="deksripsi.." name="deskripsi"></textarea>
                                                    </div>
                                                    <strong>Harga Produk :</strong>
                                                    <div class="text-sm-center">
                                                    <label>Rp.</label>
                                                    <input class="border rounded mt-1" id="" type="number" name="harga" placeholder="0" required>
                                                    </div>
                                                    <input type="hidden" value="1" name="status">  
						                    </div>
						                    <div class="modal-footer">
							                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
							                    <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
						                    </div>
                                            </form>
					                    </div>
                                    </div>
            </div>
            <!-- END of tambah MODALS-->

            <!--edit modal-->
            <?php
                $sql = 'SELECT * FROM food WHERE tipe="minuman"';
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($query))
                {
            ?>
            <div class="modal fade" id="staticModal-<?php echo $row['id_makanan'];?>" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
				                        <div class="modal-dialog modal-sm" role="document">
					                        <div class="modal-content">
						                        <div class="modal-header">
							                        <h4 class="modal-title" id="staticModalLabel">Edit Minuman</h4>
							                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								                            <span aria-hidden="true">&times;</span>
							                        </button>
						                        </div>
						                    <div class="modal-body">
							                    <form action="process/proses_editproduk2.php" method="post" enctype="multipart/form-data">
                                                <input type="text" name="id_makanan" value="<?php echo $row['id_makanan'];?>" hidden>    
                                                <strong>Gambar Produk :</strong><br>
                                                    <div class="text-sm-center">
                                                    <input type="file" name="gambar" class="form-control border inputGambar2" accept="image/*"
                                                    style="border:0; overflow: hidden;">
                                                    <small style="color:red;">abaikan jika tidak ingin diubah</small>
                                                    <div class="row">
                                                        <div class="col">
                                                            <section class="card">
                                                            <div class="card-body text-secondary"><label>Current</label>
                                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['gambar']);?>" alt="foto" style="width:200px;height:100%;">
                                                            </div>
                                                            </section>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <section class="card">
                                                            <div class="card-body text-secondary">New Picture
                                                                <img src="#" class="w-responsive mx-auto p-3 mt-2 mb-3 previewGambar2" style="width:200px;height:100%;" alt="Not Selected">
                                                            </div>
                                                            </section>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <strong>Nama Produk :</strong>
                                                    <div class="text-sm-center mb-2">    
                                                        <input class="col border rounded mt-1" type="text" placeholder="nama.." name="nama" value="<?php echo $row['nama'];?>">
                                                        <input class="col border rounded mt-1" type="text" value="minuman" name="tipe" hidden>  
                                                    </div>
                                                    <strong>Deskripsi Produk :</strong>
                                                    <div class="text-sm-center">
                                                        <textarea class="col border rounded mt-1" rows="2" placeholder="deskripsi.." name="deskripsi"><?php echo $row['deskripsi'];?></textarea>
                                                    </div>
                                                    <strong>Harga Produk :</strong>
                                                    <div class="text-sm-center">
                                                    <label>Rp.</label>
                                                    <input class="border rounded mt-1" type="number" placeholder="0" name="harga" value="<?php echo $row['harga'];?>">
                                                    </div>
                                                    <strong>Not Available / Available :</strong>
                                                    <div class="text-sm"> >>
                                                    <label class="switch switch-default switch-success mr-2">
                                                        <input type="checkbox" name="status" class="switch-input" value="<?php echo $row['status'];?>" <?php if ($row['status'] == 1) echo "checked='true'"; ?>>
                                                        <span class="switch-label"></span>
                                                        <span class="switch-handle"></span>
                                                    </label>
                                                    </div>
						                    </div>
						                    <div class="modal-footer">
							                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
							                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
						                    </div>
                                            </form>
					                    </div>
                                    </div>
            </div>
            <?php
                }
            ?>
            <!-- END of edit MODALS-->


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
