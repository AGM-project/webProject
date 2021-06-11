<?php 
// Include the database config file 
require_once 'include/connect.php'; 
 
// Initialize shopping cart class 
include_once 'cart.class.php'; 
$cart = new Cart; 
 
// If the cart is empty, redirect to the products page 
if($cart->total_items() <= 0){ 
    header("Location: orderfood.php"); 
} 
 
// Get posted data from session 
$postData = !empty($_SESSION['postData'])?$_SESSION['postData']:array(); 
unset($_SESSION['postData']); 
 
// Get status message from session 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $statusMsgType = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'include/head.php'; ?>
<body onload="load()" onunload="GUnload()">
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
        <h1>Checkout</h1>
        <div class="checkout">
            <div class="row">
                <?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
                <div class="col-md-12">
                    <div class="alert alert-success"><?php echo $statusMsg; ?></div>
                </div>
                <?php }else if(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
                <div class="col-md-12">
                    <div class="alert alert-danger"><?php echo $statusMsg; ?></div>
                </div>
                <?php } ?>
				
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your Cart</span>
                        <span class="badge badge-secondary badge-pill"><?php echo $cart->total_items(); ?></span>
                    </h4>
                    <ul class="list-group mb-3">
                        <?php 
                        if($cart->total_items() > 0){ 
                            //get cart items from session 
                            $cartItems = $cart->contents(); 
                            foreach($cartItems as $item){ 
                        ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?php echo $item["name"]; ?></h6>
                                <small class="text-muted"><?php echo 'Rp.&nbsp;&nbsp;'.number_format($item["price"], 0, ".", "."); ?>&nbsp;(<?php echo $item["qty"]; ?>)</small>
                            </div>
                            <span class="text-muted"><?php echo 'Rp.&nbsp;&nbsp;'.number_format($item["subtotal"], 0, ".", "."); ?></span>
                        </li>
                        <?php } } ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (IDR)</span>
                            <strong><?php echo 'Rp.&nbsp;&nbsp;'.number_format($cart->total(), 0, ".", "."); ?></strong>
                        </li>
                    </ul>
                    <a href="orderfood.php" class="btn btn-block btn-info">Tambah Produk</a>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Kontak penerima order</h4>
                    <form method="post" action="cartAction.php">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">Nama</label>
                                <input type="text" class="form-control" name="first_name" value="<?php echo !empty($postData['first_name'])?$postData['first_name']:''; ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="phone">Nomor Telephone</label>
                            <input type="text" class="form-control" name="phone" value="<?php echo !empty($postData['phone'])?$postData['phone']:''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name">Alamat</label>
                            <textarea class="form-control" name="address"><?php echo !empty($postData['address'])?$postData['address']:''; ?></textarea>
                            
                        </div>
                        <div class="mb-3">
                            <label for="last_name">Tentukan Koordinat</label>
                            <p><small>Langkah-langkah :<br>
                            - Ketik nama tempat di kotak search <br>
                            - Pilih tempat<br>
                            - Geser markah sesuai tempat anda<br>
                            - Selesai
                            </small><p>
                        <div id="map" style="width: 100%; height: 400px"></div>
                        Lat : <input style="width: 30%;" type="text" class="form-control" readonly id="lat" name="lat" value="<?php echo !empty($postData['lat'])?$postData['lat']:''; ?>" required>
                        Lng : <input style="width: 30%;" type="text" class="form-control" readonly id="lng" name="lng" value="<?php echo !empty($postData['lng'])?$postData['lng']:''; ?>" required><br>
                        <input type="hidden" name="action" value="placeOrder"/>
                        <button class="btn btn-success btn-lg btn-block m-t-10" type="submit">Place Order</button>
                        <br><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("include/js.php"); ?>
</body>
</html>