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
                                            <li class="list-inline-item">Riwayat Pemesanan</li>
                                        </ul>
                                    </div>
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
                                        <i class="zmdi zmdi-book"></i>Riwayat Pemesanan</h3>
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
                                    
                                    <div class="table-responsive table-data">
                                        <table class="table table-sm">
                                            <thead class="bg-light">
                                                <tr>
                                                <?php
                                            if($_SESSION['customer_sid']==session_id()){
                                                echo "<td>Tanggal Order</td>
                                                <td>Alamat Tujuan</td>
                                                <td>Status
                                                <select id='filterText' style='display:inline-block' onchange='filterText()'>
                                                    <option value='all'>All</option>
                                                    <option value='Pending'>Pending</option>
                                                    <option value='Processing'>Processing</option>
                                                    <option value='Delivering'>Delivering</option>
                                                    <option value='Completed'>Completed</option>
                                                </select>
                                                </td>

                                                
                                                <td>Action</td>
                                                ";
                                            } else {
                                                echo "<td>Tanggal Order</td>
                                                <td>Nama Pembeli</td>
                                                <td>Alamat Tujuan</td>
                                                <td>Status
                                                <select id='filterText' style='display:inline-block' onchange='filterText()'>
                                                    <option value='all'>All</option>
                                                    <option value='Pending'>Pending</option>
                                                    <option value='Processing'>Processing</option>
                                                    <option value='Delivering'>Delivering</option>
                                                    <option value='Completed'>Completed</option>
                                                </select>
                                                </td>
                                                <td>Action</td>
                                                ";
                                            }
                                            ?>
                                                </tr>
                                            </thead>
                                            <tbody id="myTable">
                                            <?php
                                            if($_SESSION['customer_sid']==session_id()){
                                                $sql = "SELECT r.*, r.id as idorder, c.*, u.nama, u.email FROM orders as r LEFT JOIN customers as c ON c.id = r.customer_id LEFT JOIN user as u ON c.login_id = u.id_user WHERE c.login_id = '$user_id' AND r.status != 'Cancelled' ORDER BY r.created DESC";
                                            } else {
                                                $sql = "SELECT r.*, r.id as idorder, c.*, u.nama, u.email FROM orders as r LEFT JOIN customers as c ON c.id = r.customer_id LEFT JOIN user as u ON c.login_id = u.id_user WHERE r.status != 'Cancelled' ORDER BY if(r.bukti_tf = '' OR r.bukti_tf is null,1,0),r.bukti_tf AND r.created ASC";
                                            }
                                            $query = mysqli_query($con, $sql);		
                                            while ($row = mysqli_fetch_array($query))
                                            {
                                            ?>
                                                <tr class="content" 
                                                    <?php if($_SESSION['admin_sid']==session_id()){
                                                        echo "";
                                                        if(($row['grand_total']+$row['ongkir'])>= 50000 && !empty($row['bukti_tf'])){
                                                            echo "style='background-color:#caffda'"; //green
                                                        } elseif(!empty($row['bukti_tf'])){
                                                            echo "style='background-color:#f4f5ff'"; //blue
                                                        } else{
                                                            echo "";
                                                        }
                                                    }?>
                                                >
                                                    <td>
                                                        <div class="table-data__info">
                                                            <?php echo date('l, j-F-Y', strtotime($row['created']));?>
                                                        </div>
                                                    </td>
                                                    <?php
                                                    if($_SESSION['customer_sid']==session_id()){
                                                        echo "";
                                                    } else {
                                                        echo "<td>
                                                            <div class='table-data__info'>
                                                            ".$row['nama']."
                                                            </div>
                                                            </td>
                                                            ";
                                                    }
                                                    ?>
                                                    <td>
                                                        <span>
                                                            <?php echo $row['address'];?>
                                                        </span>
                                                    </td>
                                                    <td><?php echo $row['status'];?></td>
                                                    <td>
                                                        <div class="col">
                                                        <a href="#" data-toggle="modal" data-target="#staticModal-<?php echo $row['idorder']; ?>">
                                                        <span class="btn btn-info btn-sm mb-2">
                                                        Details
                                                        </span></a>
                                                        </div><div class="col">
                                                        <?php
                                                        if($_SESSION['customer_sid']==session_id())
                                                        { if($row['status']=='Pending'){?>
                                                            <a href="process/proses_cancelorder.php?id=<?php echo $row['idorder']; ?>" onclick="return confirm('Yakin ingin dicancel?');">
                                                            <span class="btn btn-danger btn-sm">
                                                                Cancel Order?
                                                            </span>
                                                            </a> 
                                                        <?php
                                                        }}
                                                        ?>
                                                        </div>
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

        <!--detail modal-->
        <?php
        if($_SESSION['customer_sid']==session_id()){
            $sql = "SELECT r.*, r.id as idorder, c.*, u.nama, u.email FROM orders as r LEFT JOIN customers as c ON c.id = r.customer_id LEFT JOIN user as u ON c.login_id = u.id_user WHERE c.login_id = '$user_id'";
        } else {
            $sql = "SELECT r.*, r.id as idorder, c.*, u.nama, u.email FROM orders as r LEFT JOIN customers as c ON c.id = r.customer_id LEFT JOIN user as u ON c.login_id = u.id_user";
        }
        $query = mysqli_query($con, $sql);		
        while ($row = mysqli_fetch_array($query))
        {
        ?>
        <div class="modal fade" id="staticModal-<?php echo $row['idorder']; ?>" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="staticModalLabel">Detail Order</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <div class="modal-body">
                            <div class="row col-lg-12 center">
                            <div class="col-md-12">
                                <!-- masih pending -->
                                <?php if($_SESSION['customer_sid']==session_id() && $row['status']=='Pending'){
                                ?>
                                <div class="alert alert-warning">
                                    Silahkan lakukan pembayaran ke nomor rekening berikut :<br><br>
                                    <h5>Agam Aria Damar (<i>Bank BNI</i>)</h5>
                                    <b><p id="noreknya">0489792792</p></b>
                                    <button class="btn btn-sm btn-info" onclick="copyToClipboard('#noreknya')">Copy</button>
                                </div>
                                <?php
                                     if(empty($row['bukti_tf'])){ //Jika belum ada bukti transfer
                                ?>
                                    <form action="process/proses_tambahbuktitf.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Bukti Transfer</label>
                                            <div class="input-group m-0">
                                                <input type="text" name="id_order" value="<?php echo $row['idorder'];?>" hidden>
                                                    </div>
                                                    <div clas="col">
                                                <input type="file" name="gambar" class="form-control border inputGambar" accept="image/*" style="border:0; overflow: hidden;" required>
                                                <img src="#" class="w-responsive mx-auto p-3 mt-2 mb-3 previewGambar" style="width:200px;height:100%;">
                                                <button type="submit" class="btn btn-primary btn-sm center">Upload</button>
                                            </div>
                                        </div>
                                    </form>
                                <?php } else { //Jika sudah ada bukti transfer
                                ?>
                                <form action="process/proses_editbuktitf.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Bukti Transfer</label>
                                    <div class="input-group m-0"> 
                                        <div class="input-group">
                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['bukti_tf']);?>" alt="foto" style="width:200px;height:100%;">
                                        </div>
                                    </div>
                                        <small style="color:red;">abaikan jika tidak ingin diubah</small>
                                        <input type="file" name="gambar" class="form-control border inputGambar" accept="image/*" style="border:0; overflow: hidden;" required>
                                        <button type="submit" class="btn btn-primary btn-sm center">Upload</button>
                                </div>
                                <?php }?>

                                <!-- Sedang di proses -->
                                 <?php } if($_SESSION['customer_sid']==session_id() && $row['status']=='Processing'){
                                ?>
                                <div class="alert alert-info">
                                    Pesanan sedang diproses
                                </div>

                                <!-- Sedang di kirim -->
                                <?php } if($_SESSION['customer_sid']==session_id() && $row['status']=='Delivering'){
                                ?>
                                <div class="alert alert-success">
                                    Pesanan sedang dikirim
                                </div>

                                <!-- Sampai tujuan -->
                                <?php } if($_SESSION['customer_sid']==session_id() && $row['status']=='Completed'){
                                ?>
                                <div class="alert alert-success">
                                    Pesanan sudah diterima customer
                                </div>
                                <?php }?>

                            </div>
                            <table class="table-responsive table-borderless table-sm d-inline-flex mb-4">
                                <tbody>
                                    <tr><td>ID ORDER</td><td>: </td><td>#<?php echo $row['idorder']; ?></td></tr>
                                    <tr><td>Total Harga Produk </td><td>: </td><td><?php echo 'Rp.&nbsp;&nbsp;'.number_format($row['grand_total'], 0, ".", ".").'';?></td></tr>
                                    <tr><td>Ongkir </td><td>: </td><td><?php echo 'Rp.&nbsp;&nbsp;'.number_format($row['ongkir'], 0, ".", ".").'';?></td></tr>
                                    <tr><td>Jarak</td><td>: </td><td><?php echo $row['jarak']; ?> KM</td></tr>
                                    <tr><td><strong>Grand Total<strong></td><td>: </td><td>
                                        <?php
                                        $grandtotal = $row['ongkir'] + $row['grand_total'];
                                        echo '<strong>Rp.&nbsp;&nbsp;'.number_format($grandtotal, 0, ".", ".").'</strong>';
                                        ?>
                                    </td></tr>
                                    <tr><td>Tanggal Order </td></td><td>: <td><?php echo date('H:i:s', strtotime($row['created']) /*+ 25200*/); ?></td></tr>
                                    <tr><td>Nama Pembeli <td>: </td><td><?php echo $row['nama']; ?></td>
                                    <tr><td>Email </td><td>: </td><td><?php echo $row['email']; ?></td></tr>
                                    <tr><td>Ditujukan kepada <td>: </td><td><?php echo $row['first_name']; ?></td>
                                    <tr><td>Alamat Tujuan</td><td>: </td><td><?php echo $row['address']; ?></td></tr>
                                    <tr><td>Koordinat</td><td>: </td><td id="fungsiCopy"><?php echo $row['lat'].', '.$row['lng']; ?></td></tr>
                                    <tr><td>No. Telepon Penerima </td><td>: </td><td><?php echo $row['phone']; ?></td></tr>

                                    <?php
                                    if($_SESSION['admin_sid']==session_id())
                                    {?>
                                        <tr><td>Bukti Transfer</td><td>: </td><td></td></tr>
                                        <tr><td colspan="3">
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['bukti_tf']);?>" alt="Card image cap" style="width:80%;">
                                            </td>
                                        </tr>
                                    <?php }?>

                                    <tr><td>Status Order </td><td>: </td><td class="border text-center"><strong><?php echo $row['status']; ?></strong>
                                    <?php
                                        if($_SESSION['admin_sid']==session_id())
                                        {
                                            if($row['status']!='Cancelled'){
                                            echo "<tr><td>Update Status Order to</td><td>:</td><td>
                                            <form method='post' action='process/proses_editorder.php?id=".$row['idorder']."'>
                                            <select name='statusnya'>
                                                <option value='Processing'>Processing</option>
                                                <option value='Delivering'>Delivering</option>
                                                <option value='Completed'>Completed</option>
                                            </select>
                                            <button class='btn btn-sm btn-primary' type='submit'>Update</button>
                                            </form></td></tr>";
                                            } else {
                                                echo '';
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <table class="table table-responsive table-stripped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Harga</th>
                                        <th>QTY</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    // Get order items from the database 
                                    $result2 = $con->query("SELECT i.*, p.nama, p.harga FROM order_items as i LEFT JOIN food as p ON i.product_id = p.id_makanan WHERE i.order_id = ".$row['idorder']); 
                                    if($result2->num_rows > 0){  
                                        while($item = $result2->fetch_assoc()){
                                            $price = $item["harga"]; 
                                            $quantity = $item["quantity"]; 
                                            $sub_total = ($price*$quantity); 
                                    ?>
                                    <tr>
                                        <td><?php echo $item["nama"]; ?></td>
                                        
                                        <td><?php echo 'Rp.&nbsp;&nbsp;'.number_format($price, 0, ".", "."); ?></td>
                                        <td><?php echo $quantity; ?></td>
                                        <td><?php echo 'Rp.&nbsp;&nbsp;'.number_format($sub_total, 0, ".", "."); ?></td>
                                    </tr>
                                    <?php
                                    } 
                                    } ?>
                                </tbody>
                            </table>
                        </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
                        <!-- END of detail MODALS-->

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
