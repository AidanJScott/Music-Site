<?php 
	require 'includes/header.php';
	require_once '../../pdo_connect.php';
	$sql = 'SELECT * FROM music_site_items';
	$result = $dbc->query($sql);
	$error = $dbc->errorInfo()[2];
	if (!$error) {
		$numRows= $result->rowCount();
	} 
	else{
		echo "We are unable to process your request at  this  time. Please try again later.";
		include 'includes/footer.php'; 
		exit;
	}
	
	//This function creates a title from the filename of each image
	function shortTitle ($title){
		$title = substr($title, 0, -4); #remove the .ext from each title
		$title = str_replace('_', ' ', $title); #replace underscores with blanks
		$title = ucwords($title); #capitalize each word
		return $title;
	}
	?>

  <main>
	<h2>SHOP</h2>
	<h3>PLEASE CLICK THE VIEW DETAILS BUTTON TO MAKE A PURCHASE
	<?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
					echo " OR ";
					echo "<a href=\"cart_view.php\">VIEW YOUR CART.</a>";
				}?>
	</h3>   
	
    <table>
        <tr>
            <th></th>
			<th></th>
			<th></th>
        </tr>
		<?php foreach($result as $row) { 
				$title = shortTitle($row['filename']);
		?>
			<tr>
				<td><?= $title; ?></td>
				<td><img src = "media/images/<?= $row['filename'];?>"></td>
				<td>
					<form action="product_details.php" method="get">
						<input type="hidden" name="image_id" value="<?= $row['image_id'];?>">
						<input type="submit" name="submit" value="View Details">
					</form>
				</td>
			</tr>
		
    <?php } //end while loop ?>
      
    </table>
  </main>
<?php include 'includes/footer.php'; ?>