<?php 
session_start();
if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = array();
}
//The cart workings
	// Determine the action to perform
	if(isset($_GET['action'])) {
		$action = $_GET['action'];
	}
	elseif(isset($_POST['action'])) {
		$action = $_POST['action'];
	}
	else {
		$action = 'show_add_item';
	}
	// Add or update cart as needed
	switch($action) {
		case 'details':
			include('item_details.php');
			break;
		case 'add':
			$imgID = filter_var($_POST['image_id'], FILTER_SANITIZE_NUMBER_INT );
			$qty = filter_var($_POST['qty'], FILTER_SANITIZE_NUMBER_INT);
			if (isset($_SESSION['cart'][$imgID])) { //item already in cart
				$_SESSION['cart'][$imgID]['quantity'] += $qty; //update the quantity
				//Get the price from the cart in $_SESSION and set it to $cart_price
				$cart_price = $_SESSION['cart'][$imgID]['price'];
			} else { // New product to the cart.
				// Get the print's data from the database:
				require_once '../../pdo_connect.php'; // Connect to the database.
				$getImage= "SELECT * FROM music_site_items WHERE id = ?";
				$stmt= $dbc->prepare($getImage);	
				$stmt->bindParam(1, $imgID);
				$stmt->execute();
				$rows = $stmt->rowCount();
				if ($rows == 1) { // Valid print ID.
					// Fetch the information.
					$item = $stmt->fetch();
					$imgID = $item['id'];
					$imgTitle = $item['caption'];
					$imgPrice = $item['price'];
					
					// Add to the cart:
					$_SESSION['cart'][$imgID]['caption'] = $imgTitle;
					$_SESSION['cart'][$imgID]['price'] = $imgPrice;
					$_SESSION['cart'][$imgID]['quantity'] = 1;
					
					
					
				} else { // Not a valid print ID.
					require 'includes/header.php';
					echo '<main><h2>We are unable to process your request at  this  time.</h2><h3>Please try again later.</h3></main>';
					include 'includes/footer';
					exit;
				}	
			} // end of new product else
			include('cart_view.php');
			break;
		case 'update':
			$new_qty_list = filter_var($_POST['newqty'], FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
			foreach($new_qty_list as $img => $qty) {
				if ($_SESSION['cart'][$img]['quantity'] != $qty) {
					 $quantity = (int) $qty;
					if (isset($_SESSION['cart'][$img])) {
						if ($quantity <= 0) {
							unset($_SESSION['cart'][$img]);
						} else {
							$_SESSION['cart'][$img]['quantity'] = $quantity;
						}
					}
				}
			}
			include('cart_view.php');
			break;
		case 'show_cart':
			include('cart_view.php');
			break;
		case 'empty_cart':
			unset($_SESSION['cart']);
			include('cart_view.php');
			break;
	} //end switch
?>
