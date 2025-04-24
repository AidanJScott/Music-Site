<?php
    ini_set('display_errors', 1);

	require 'includes/header.php';
	require_once '../../pdo_connect.php';
	echo '<main>';
	
	function shortTitle ($title){
		$title = substr($title, 0, -4);
		$title = str_replace('_', ' ', $title);
		$title = strtoupper($title);
		return $title;
	}
	if(isset($_GET['image_id'])) {
		$imgID = filter_var($_GET['image_id'], FILTER_SANITIZE_NUMBER_INT);
		$getDetails= "SELECT * FROM music_site_items WHERE id = ?";
		$stmt = $dbc->prepare($getDetails);
		$stmt->bindParam(1, $imgID);
		$stmt->execute();
		$rows = $stmt->rowCount();
		if ($rows == 1) { // Valid print ID.
			// Fetch the information.
			$item = $stmt->fetch();
			// Retrieve the query results into scalar variables
			$imageID = $item['id'];
			$filename = $item['filename'];		
			$caption = $item['caption'];
			$price = $item['price'];
			$description = $item['description'];
?>	
			<h2>PURCHASE <?php echo shortTitle($filename); ?>:</h2>					
			<p><img src="media/images/<?php echo $filename; ?>" alt="<?php echo $caption; ?>"></p>
			<h3><strong>DESCRIPTION:</strong></h3>
			<h4><?php echo strtoupper($caption); ?></h4>
			<h4><?php echo strtoupper($description); ?></h4>
			<h4><strong>Price: </strong>$<?php echo $price; ?>
			<!-- Insert Add to Cart button here -->
			<form style="display:inline;" action="cart.php" method="post">
				<input type="hidden" name="action" value="add">
				<input type="hidden" name="image_id" value="<?php echo $imageID; ?>">
				<input type="hidden" name="qty" value="1">
				<input type="submit" name="send" value="ADD TO CART">
			</form>	
			<?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
					echo "<a href=\"cart_view.php\"><button type=\"button\"> VIEW CART</button></a>";
				}?>
			</h4>						
		<?php }
		else {
			echo "<main><h2>WE ARE UNABLE TO PROCESS YOUR REQUEST AT THIS TIME.</h2><h3>PLEASE TRY AGAIN LATER.</h3></main>";
			include 'includes/footer.php';
			exit;
		}
	}else {
		echo "<main><h2>YOU HAVE REACHED THIS PAGE IN ERROR</h2><h3>USE THE MENU ABOVE TO REVIEW OUR PRODUCTS.</h3></main>";
		include 'includes/footer.php'; 
		exit;
	   } 
echo '</main>';
include 'includes/footer.php'; ?>