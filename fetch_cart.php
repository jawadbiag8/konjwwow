
                                
<?php

//fetch_cart.php



session_start();

if(isset($_SESSION['merchant'])){
    $checkout_url = 'shopping-cart.php';
}else{
    $checkout_url = 'login.php';
}

$total_price = 0;
$total_item = 0;

$output = '
<form action="place_order.php" method="post">   <div class="select-items">

                                        <table>
                                            <tbody>
';
if(!empty($_SESSION["shopping_cart"]))
{
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
		$output .= '
		<tr>
        <td class="si-pic"><img style="height:100px;" src="common/dist/img/'.$values["product_img"].'" alt=""></td>
                                                    <td class="si-text">
                                                    <input type="hidden" value="'.$values["product_quantity"].'" name="product_quantity[]">
                                                    <input type="hidden" value="'.$values["product_id"].'" name="product_id[]">
                                                    <input type="hidden" value="'.$_SESSION['merchant']['mer_id'].'" name="marchant_id[]">
                                                    <input type="hidden" value="'.$values["vendor_id"].'" name="vendor_id[]">
                                                        <div class="product-selected">
                                                            <p>RS-'.$values["product_price"].' x '.$values["product_quantity"].'</p>
                                                            <h6>'.$values["product_name"].'</h6>
                                                        </div>
                                                    </td>
                                                    <td class="si-close">
                                                        <i class="ti-close delete" id="'. $values["product_id"].'" ></i>
                                                    </td>
        </tr>
		';
		$total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
		$total_item = $total_item + 1;
	}
	$output .= '
	</tbody>
                                        </table>
                                        </div>



                                        <div class="select-total">
                                        <span>total:</span>
                                        <h5>RS-'.number_format($total_price, 2).'</h5>
    </div>';
    if(!isset($_SESSION['merchant'])){
    $output .='<div class="select-button">
                                        <a href="#" id="clear_cart" class="primary-btn view-card">CLEAR CART</a>
                                        <a href="'.$checkout_url.'" class="primary-btn checkout-btn">CHECK OUT</a>
    </div>
	';
    }elseif(isset($_SESSION['merchant'])){
        $output .=' <div class="select-button">
                                    <br><b>Please Enter Delivery Address:</b><br>
                                    <textarea name="address" style="width:100%;" placeholder="Please Enter Devivery Address." required></textarea>
                                    
                                        <input type="submit" name="place_order" value="Place Order" class="primary-btn checkout-btn">
    </div></form>
	';
    }
}
else
{
	$output .= '
    <tr>
    	<td colspan="5" align="center">
    		Your Cart is Empty!
    	</td>
    </tr>
    ';
}
$output .= '';
$data = array(
	'cart_details'		=>	$output,
	'total_price'		=>	'RS' . number_format($total_price, 2),
	'total_item'		=>	$total_item
);	

echo json_encode($data);


?>