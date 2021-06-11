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
                                            <li class="list-inline-item">Setelan Akun</li>
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
                                <!-- USER DATA-->
                                <?php

                                $id = $_GET['id'];
                                    $sql = "SELECT * FROM user WHERE id_user='$id'";
                                    $query = mysqli_query($con, $sql);		
                                    $row = mysqli_fetch_array($query);
                                ?>
                                <form action="process/proses_edituser2.php" method="post" enctype="multipart/form-data">
                            <input type="text" name="id_user" value="<?php echo $row['id_user'];?>" hidden>
                            <input type="text" name="role" value="<?php echo $row['role'];?>" hidden> 
                            <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" value="<?php echo $row['nama'];?>" name="nama" placeholder="nama" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <div class="input-group">
                                        <div class="col col-md-5">
                                            <div class="form-check-inline form-check">
                                                <input type="radio" id="" name="gender" value="L" class="form-check-input" <?php if($row['gender']=='L'){echo'checked';}?> required>
                                                &nbsp;Laki-laki
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="col col-md-5">
                                            <div class="form-check-inline form-check">
                                                <input type="radio" id="" name="gender" value="P" class="form-check-input" <?php if($row['gender']=='P'){echo'checked';}?>>
                                                &nbsp;Perempuan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir <small>(tgl/bln/thn)</small></label>
                                    <div class="input-group">
                                        <div class="input-group-addon" id="example-date-input">
                                            <i class="fa fa-calendar-o"></i>
                                        </div>
                                            <input type="date" value="<?php echo date('Y-m-d',strtotime($row["tgl_lahir"])) ?>" name="tgl_lahir" placeholder="" class="form-control col col-md-5" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <div class="input-group">
                                        <textarea name="alamat" id="" rows="5" placeholder="alamat" class="form-control" required><?php echo $row['alamat'];?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Foto <small>[disarankan 1x1(</i>square</i>)]</small></label>
                                    <div class="input-group m-0">
                                            <input type="file" name="gambar" class="form-control inputGambar border" accept="image/*" style="border:0; overflow: hidden;">
                                            <div class="input-group">
                                                <small style="color:red;">abaikan jika gambar tidak ingin diubah</small>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <section class="card">
                                            <div class="card-body text-secondary"><label>Current</label>
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['gambar']);?>" alt="foto" style="width:200px;height:100%;">
                                            </div>
                                            </section>
                                        </div>
                                        <div class="col-md-4">
                                            <section class="card">
                                            <div class="card-body text-secondary">New Photo
                                            <img src="#" class="w-responsive mx-auto p-3 mt-2 mb-3 previewGambar" style="width:200px;height:100%;" alt="Tak ada foto yg dipilih">
                                            </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <input type="text" value="<?php echo $row['email'];?>" name="email" placeholder="email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </div>
                                        <input type="password" name="password" placeholder="password" class="form-control">
                                    </div>
                                    <small style="color:red;">kosongkan jika tidak ingin diubah</small>
                                </div>
                            </div>
                            <button class="au-btn au-btn--block au-btn--blue m-b-20 m-t-20" type="submit">Confirm</button>
                            </form>
                                <!-- END USER DATA-->
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
