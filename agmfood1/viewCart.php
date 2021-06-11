<?php 
// Initialize shopping cart class 
include_once 'cart.class.php'; 
$cart = new Cart; 
?>

<!DOCTYPE html>
<html lang="en">
<head>

<?php include("include/head.php");?>

<script>
function updateCartItem(obj,id){
    $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
        if(data == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });
}
</script>
</head>
<body>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
        <h1>SHOPPING CART</h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="45%">Produk</th>
                                            <th width="10%">Harga</th>
                                            <th width="15%">Quantity</th>
                                            <th class="text-right" width="20%">Total</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if($cart->total_items() > 0){ 
                                            // Get cart items from session 
                                            $cartItems = $cart->contents(); 
                                            foreach($cartItems as $item){ 
                                        ?>
                                        <tr>
                                            <td><?php echo $item["name"]; ?></td>
                                            <td><?php echo 'Rp.&nbsp;&nbsp;'.number_format($item["price"], 0, ".", "."); ?></td>
                                            <td>
                                                <input class="form-control" type="number" id="kurangtambah" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"/>
                                              </td>
                                            <td class="text-right"><?php echo 'Rp.&nbsp;&nbsp;'.number_format($item["subtotal"], 0, ".", "."); ?></td>
                                            <td class="text-right"><button class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus?" onclick="return confirm('Are you sure?')?window.location.href='cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>':false;"><i class="fas fa-trash"></i> </button> </td>
                                        </tr>
                                        <?php } }else{ ?>
                                        <tr><td colspan="5"><p>Your cart is empty.....</p></td>
                                        <?php } ?>
                                        <?php if($cart->total_items() > 0){ ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td><strong>Cart Total</strong></td>
                                            <td class="text-right"><strong><?php echo 'Rp.&nbsp;&nbsp;'.number_format($cart->total(), 0, ".", "."); ?></strong></td>
                                            <td></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col mb-2"> <br>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <a href="orderfood.php" class="btn btn-sm btn-block btn-info">
                                    <i class="fas fa-arrow-alt-circle-left">&nbsp;&nbsp;Lanjutkan Belanja</i></a>
                                </div><br><br>
                                <div class="col-sm-12 col-md-6 text-right">
                                    <?php if($cart->total_items() > 0){ ?>
                                    <a href="checkout.php" class="btn btn-sm btn-block btn-primary">
                                    <i class="fas fa-cart-arrow-down">&nbsp;&nbsp;Checkout</i></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("include/js.php"); ?>
</body>
</html>