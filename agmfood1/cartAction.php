<?php 
// Initialize shopping cart class 
require 'cart.class.php'; 
$cart = new Cart; 
 
// Include the database config file 
require 'include/connect.php'; 
 
// Default redirect page 
$redirectLoc = 'orderfood.php'; 
 
// Process request based on the specified action 
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){ 
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){ 
        $productID = $_REQUEST['id']; 
         
        // Get product details 
        $query = $con->query("SELECT * FROM food WHERE id_makanan = ".$productID); 
        $row = $query->fetch_assoc(); 
        $itemData = array( 
            'id' => $row['id_makanan'], 
            'name' => $row['nama'], 
            'price' => $row['harga'], 
            'qty' => 1 
        ); 
         
        // Insert item to cart 
        $insertItem = $cart->insert($itemData); 
         
        // Redirect to cart page 
        $redirectLoc = $insertItem?'viewCart.php':'orderfood.php'; 
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){ 
        // Update item data in cart 
        $itemData = array( 
            'rowid' => $_REQUEST['id'], 
            'qty' => $_REQUEST['qty'] 
        ); 
        $updateItem = $cart->update($itemData); 
         
        // Return status 
        echo $updateItem?'ok':'err';die; 
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){ 
        // Remove item from cart 
        $deleteItem = $cart->remove($_REQUEST['id']); 
         
        // Redirect to cart page 
        $redirectLoc = 'viewCart.php'; 
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0){ 
        $redirectLoc = 'checkout.php'; 
         
        // Store post data 
        $_SESSION['postData'] = $_POST; 
     
        $first_name = strip_tags($_POST['first_name']);  
        $phone = strip_tags($_POST['phone']); 
        $address = strip_tags($_POST['address']);
        $lat = strip_tags($_POST['lat']);
        $lng = strip_tags($_POST['lng']);

        $center_lat = -6.192450152906034;
        $center_lng = 106.98838840118373;

        /**
         * Calculates the great-circle distance between two points, with
         * the Haversine formula.
         * @param float $latitudeFrom Latitude of start point in [deg decimal]
         * @param float $longitudeFrom Longitude of start point in [deg decimal]
         * @param float $latitudeTo Latitude of target point in [deg decimal]
         * @param float $longitudeTo Longitude of target point in [deg decimal]
         * @param float $earthRadius Mean earth radius in [m]
         * @return float Distance between points in [m] (same as earthRadius)
         */
        function haversineGreatCircleDistance(
            $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius)
        {
            // convert from degrees to radians
            $latFrom = deg2rad($latitudeFrom);
            $lonFrom = deg2rad($longitudeFrom);
            $latTo = deg2rad($latitudeTo);
            $lonTo = deg2rad($longitudeTo);
        
            $latDelta = $latTo - $latFrom;
            $lonDelta = $lonTo - $lonFrom;
        
            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
            return $angle * $earthRadius;
        }

        $distance = haversineGreatCircleDistance($center_lat, $center_lng, $lat, $lng, 6371);
        $ongkir = $distance * 1500;
         
        $errorMsg = ''; 
        if(empty($first_name)){ 
            $errorMsg .= 'Please enter your first name.<br/>'; 
        } 
        if(empty($phone)){ 
            $errorMsg .= 'Please enter your phone number.<br/>'; 
        } 
        if(empty($address)){ 
            $errorMsg .= 'Please enter your address.<br/>'; 
        }
        if(empty($lat)){ 
            $errorMsg .= 'Please enter your lat.<br/>'; 
        } 
        if(empty($lat)){ 
            $errorMsg .= 'Please enter your lat.<br/>'; 
        } 
         
        if(empty($errorMsg)){ 
            // Insert customer data in the database 
            $insertCust = $con->query("INSERT INTO customers (first_name, phone, address, lat, lng, jarak, ongkir, login_id) VALUES ('".$first_name."', '".$phone."', '".$address."', '".$lat."', '".$lng."','".$distance."', '".$ongkir."', '".$user_id."')"); 
             
            if($insertCust){ 
                $custID = $con->insert_id; 
                 
                // Insert order info in the database 
                
                $insertOrder = $con->query("INSERT INTO orders (customer_id, grand_total, created, status) VALUES ($custID, '".$cart->total()."', NOW() , 'Pending')"); 
             
                if($insertOrder){ 
                    $orderID = mysqli_insert_id($con);
                     
                    // Retrieve cart items 
                    $cartItems = $cart->contents();
                     
                    // Prepare SQL to insert order items
                    $sqll = array();
                    foreach($cartItems as $item){
                        $sqll[] = "('".$orderID."','".$item['id']."','".$item['qty']."')";
                    // $sqll[] = "INSERT INTO order_items (order_id, product_id, quantity) VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."')"; 
                    } 
                    
                     
                    // Insert order items in the database 
                    // $insertOrderItems = mysqli_multi_query($con, $sqll);
                    $insertOrderItems = mysqli_query($con, 'INSERT INTO order_items (order_id, product_id, quantity) VALUES '.implode(',', $sqll));
                     
                    if($insertOrderItems){ 
                        // Remove all items from cart 
                        $cart->destroy(); 
                         
                        // Redirect to the status page 
                        $redirectLoc = 'orderSuccess.php?id='.$orderID; 
                    }else{ 
                        $sessData['status']['type'] = 'error'; 
                        $sessData['status']['msg'] = 'Some problem occurred, please try again.'; 
                    } 
                }else{ 
                    $sessData['status']['type'] = 'error'; 
                    $sessData['status']['msg'] = 'Some problem occurredd, please try again.'; 
                } 
            }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Some problem occurreddd, please try again.'; 
            } 
        }else{ 
            $sessData['status']['type'] = 'error'; 
            $sessData['status']['msg'] = 'Please fill all the mandatory fields.<br>'.$errorMsg;  
        } 
        $_SESSION['sessData'] = $sessData; 
    } 
} 
 
// Redirect to the specific page 
header("Location: $redirectLoc"); 
exit();