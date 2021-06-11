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
                                            <li class="list-inline-item">Data User</li>
                                        </ul>
                                    </div>
                                    <button type="button" class="au-btn au-btn-icon au-btn--green" data-toggle="modal" data-target="#staticModal">
                                            <i class="zmdi zmdi-plus"></i>add user
										</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- USER DATA-->
                                <div class="user-data m-b-20">
                                    <h3 class="title-3 m-b-15">
                                        <i class="zmdi zmdi-account-calendar"></i>Data User</h3>
                                    <!-- <div class="filters m-b-45">
                                        <div class="rs-select4--dark rs-select4--md m-r-8 rs-select4--border">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" id="myInput" name="search" class="form-control" placeholder="Cari data..">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-search"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="table-responsive-sm table-data">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>Photo</td>
                                                    <td>Name</td>
                                                    <td>Gender</td>
                                                    <td>Birthday</td>
                                                    <td>Alamat</td>
                                                    <td>Role</td>
                                                    <td>Action</td>
                                                </tr>
                                            </thead>
                                            <tbody id="myTable">
                                            <?php
                                            $sql = 'SELECT * FROM user';
                                            $query = mysqli_query($con, $sql);		
                                            while ($row = mysqli_fetch_array($query))
                                            {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['gambar']);?>" alt="foto">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h5><?php echo $row['nama'];?></h5>
                                                            <span>
                                                                <a target="_blank" rel="noopener noreferrer" href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $row['email'];?>"><?php echo $row['email'];?></a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            <?php if($row['gender']=="L"){
                                                                    echo "Laki-laki";
                                                                }else{
                                                                    echo"Perempuan";
                                                                }?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            <?php echo date('j F Y', strtotime($row['tgl_lahir']));?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            <?php echo $row['alamat'];?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="role <?php if($row['role']=="Administrator"){
                                                                    echo "admin";
                                                                }else{
                                                                    echo"user";
                                                                }?>">
                                                                <?php echo $row['role'];?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#staticModal-<?php echo $row['id_user']; ?>">
                                                        <span class="btn btn-info btn-sm mb-2">
                                                            <i class="fas fa-edit"></i>&nbsp;Edit
                                                        </span></a>
                                                        <a href="process/proses_hapususer.php?id=<?php echo $row['id_user']; ?>" onclick="return confirm('Yakin ingin hapus?');">
                                                        <span class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i>&nbsp;Hapus
                                                        </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END USER DATA-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
            <!--tambah modal-->
            <div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="staticModalLabel">Tambah User</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <div class="modal-body">
                            <form action="process/proses_tambahuser.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" id="" name="nama" placeholder="nama" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <div class="input-group">
                                        <div class="col col-md-5">
                                            <div class="form-check-inline form-check">
                                                <input type="radio" id="" name="gender" value="L" class="form-check-input" required>
                                                &nbsp;Laki-laki
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="col col-md-5">
                                            <div class="form-check-inline form-check">
                                                <input type="radio" id="" name="gender" value="P" class="form-check-input">
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
                                            <input type="date" name="tgl_lahir" placeholder="" class="form-control col col-md-5" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <div class="input-group">
                                        <textarea name="alamat" id="" rows="5" placeholder="alamat" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Foto <small>[disarankan 1x1(</i>square</i>)]</small></label>
                                    <div class="input-group m-0">
                                            <input type="file" name="gambar" class="form-control inputGambar border" accept="image/*" style="border:0; overflow: hidden;">
                                    </div>
                                    <div class="input-group">
                                    <img src="#" class="w-responsive mx-auto p-3 mt-2 mb-3 previewGambar" style="width:200px;height:100%;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <input type="text" id="" name="email" placeholder="email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </div>
                                        <input type="password" id="" name="password" placeholder="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <div class="input-group">
                                        <div class="col col-md-5">
                                            <div class="form-check-inline form-check">
                                                <input type="radio" id="" name="role" value="Administrator" class="form-check-input" required>
                                                &nbsp;Admin
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="col col-md-5">
                                            <div class="form-check-inline form-check">
                                                <input type="radio" id="" name="role" value="Customer" class="form-check-input">
                                                &nbsp;Customer
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                            <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
                            <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
                        <!-- END of tambah MODALS-->

    <!--edit modal-->
    <?php
                $sql = 'SELECT * FROM user';
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($query))
                {
            ?>
            <div class="modal fade" id="staticModal-<?php echo $row['id_user'];?>" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="staticModalLabel">Edit User</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <div class="modal-body">
                            <form action="process/proses_edituser.php" method="post" enctype="multipart/form-data">
                            <input type="text" name="id_user" value="<?php echo $row['id_user'];?>" hidden> 
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
                                        <textarea name="alamat" id="" rows="5" placeholder="alamat" class="form-control"><?php echo $row['alamat'];?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Foto <small>[disarankan 1x1(</i>square</i>)]</small></label>
                                    <div class="input-group m-0">
                                            <input type="file" name="gambar" class="form-control inputGambar border" accept="image/*" style="border:0; overflow: hidden;">
                                            <div class="input-group">
                                                <small style="color:red;">abaikan jika tidak ingin diubah</small>
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
                                <div class="form-group">
                                    <label>Role</label>
                                    <div class="input-group">
                                        <div class="col col-md-5">
                                            <div class="form-check-inline form-check">
                                                <input type="radio" id="" name="role" value="Administrator" class="form-check-input" <?php if($row['role']=='Administrator'){echo'checked';}?> required>
                                                &nbsp;Admin
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="col col-md-5">
                                            <div class="form-check-inline form-check">
                                                <input type="radio" id="" name="role" value="Customer" class="form-check-input" <?php if($row['role']=='Customer'){echo'checked';}?>>
                                                &nbsp;Customer
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
            <!-- END of edit MODALS-->
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
