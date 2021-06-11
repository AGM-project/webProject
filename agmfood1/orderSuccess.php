<?php 
if(!isset($_REQUEST['id'])){ 
    header("Location: orderfood.php"); 
} 
 
// Include the database config file 
require_once 'include/connect.php'; 
 
// Fetch order details from database 
$result = $con->query("SELECT r.*, r.id as idorder, c.*, c.id as idcust, u.nama, u.email FROM orders as r LEFT JOIN customers as c ON c.id = r.customer_id LEFT JOIN user as u ON c.login_id = u.id_user WHERE r.id = ".$_REQUEST['id']); 
    $orderInfo = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include("include/head.php");?>

</head>
<body>
<div class="main-content">
    <div class="section__content section__content--p30">
    <div class="container-fluid">
    <h1>ORDER STATUS</h1>
    <div class="col-12">
        <?php if(!empty($orderInfo)) { ?>
            <div class="col-md-12">
                <div class="alert alert-success">Order Sukses. Silahkan lakukan pembayaran ke nomor rekening berikut :<br><br>
                    <h5>Agam Aria Damar (<i>Bank BNI</i>)</h5>
                    <b><p id="noreknya">0489792792</p></b>
                    <button class="btn btn-sm btn-info" onclick="copyToClipboard('#noreknya')">Copy</button>
                </div>
            </div>
			
            <!-- Order status & shipping info -->
            <div class="row col-lg-6 ord-addr-info col-border-1 align-self-lg-center">
            <h3><u>Info Order</u></h3>
            <table class="table table-borderless table-sm d-inline-flex">
            <tbody>
            <tr><td>ID ORDER</td><td>: </td><td>#<?php echo $orderInfo['idorder']; ?></td></tr>
            <tr><td>Total Harga Produk </td><td>: </td><td><?php echo 'Rp.&nbsp;&nbsp;'.number_format($orderInfo['grand_total'], 0, ".", ".").'';?></td></tr>
            <tr><td>Ongkir </td><td>: </td><td><?php echo 'Rp.&nbsp;&nbsp;'.number_format($orderInfo['ongkir'], 0, ".", ".").'';?></td></tr>
            <tr><td>Jarak</td><td>: </td><td><?php echo $orderInfo['jarak']; ?>&nbsp;&nbsp;KM</td></tr>
            <tr><td><strong>Grand Total<strong></td><td>: </td><td>
                <?php
                $grandtotal = $orderInfo['ongkir'] + $orderInfo['grand_total'];
                echo '<strong>Rp.&nbsp;&nbsp;'.number_format($grandtotal, 0, ".", ".").'</strong>';
                ?>
            </td></tr>
            <tr><td>Tanggal Order </td></td><td>: <td><?php echo date('H:i:s', strtotime($orderInfo['created']) /*+ 25200*/); ?></td></tr>
            <tr><td>Nama Pembeli <td>: </td><td><?php echo $orderInfo['nama']; ?></td>
            <tr><td>Email </td><td>: </td><td><?php echo $orderInfo['email']; ?></td></tr>
            <tr><td>Ditujukan kepada <td>: </td><td><?php echo $orderInfo['first_name']; ?></td>
            <tr><td>Alamat Tujuan</td><td>: </td><td><?php echo $orderInfo['address']; ?></td></tr>
            <tr><td>Koordinat</td><td>: </td><td><?php echo $orderInfo['lat'].', '.$orderInfo['lng']; ?></td></tr>
            <tr><td>No. Telepon Penerima </td><td>: </td><td><?php echo $orderInfo['phone']; ?></td></tr>
            <tr><td>Status Pengiriman </td><td>: </td><td><strong><?php echo $orderInfo['status']; ?></strong></td></tr>
            </tbody>
            </table>
            <!-- Order items -->
            <div class="row col-lg-12 center">
                <table class="table table-stripped" mb->
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
                        $result2 = $con->query("SELECT i.*, p.nama, p.harga FROM order_items as i LEFT JOIN food as p ON i.product_id = p.id_makanan WHERE i.order_id = ".$orderInfo['idorder']); 
                        if($result2->num_rows > 0){  
                            while($item = $result2->fetch_assoc()){
                                $price = $item['harga']; 
                                $quantity = $item['quantity']; 
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
                <div class="col-sm-12  col-md-12">
                        <br><a href="statusorder.php" class="btn btn-block btn-primary">Ke Riwayat Pemesanan</a><br><br>
                    </div>
            </div>
        <?php } else{ ?>
        <div class="col-md-12">
            <div class="alert alert-danger">Your order submission failed.</div>
            <div class="row">
            <div class="col">
                    <a href="orderfood.php" class="btn btn-block btn-light btn-lg-12">Continue Shopping</a>
            </div></div>
        </div>
        <?php } ?>
    </div>
    </div>
    </div>
</div>
<?php include("include/js.php"); ?>
</body>
</html>