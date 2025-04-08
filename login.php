<?php //This is the login page for registered users
require_once '../secure_conn.php';
require 'includes/header.php';
if (isset($_POST['send']) && $_POST['send']=="Login" ) {
	$errors = array();
	
	$valid_email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);	//returns a string or null if empty or false if not valid	
	if (empty($_POST['email']))
		$errors['email'] = 'PLEASE ENTER AN EMAIL ADDRESS';
	elseif (!$valid_email)
		$errors['email'] = 'PLEASE ENTER A VALID EMAIL ADDRESS';
	else 
		$email = $valid_email;
	
	$password = trim($_POST['password']);
	if (empty($password))
		$errors['pw']= "A PASSWORD IS REQUIRED";

	while (!$errors){ 
		try{
			require_once ('../../pdo_connect.php'); // Connect to the db.
			//Query for email
			$sql = "SELECT * FROM music_site_users WHERE email = ?";
			$stmt = $dbc->prepare($sql);
			$stmt->bindParam(1, $email);
			$stmt->execute();
			$numRows = $stmt->rowCount();
			if ($numRows==0) 
				$errors['no_email'] = "THAT EMAIL ADDRESS WASN'T FOUND";
			else { // email found, validate password
				$result = $stmt->fetch(); //convert the result object pointer to an associative array 
				$pw_hash=$result['password'];
				if (password_verify($password, $pw_hash )) { //passwords match
					$name = $result['name'];
					$_SESSION['name'] = $name;
					$_SESSION['email'] = $email;
					header('Location: loggedIn.php');
					
					exit;
				}
				else {
					$errors['wrong_pw'] = "That isn't the correct password";
				}
			} 
			}catch (PDOException $e){
				echo $e->getMessage();	
			}
	   } // end while 	
} //end isset $_POST['send']
?>
	<form method="post" action="login.php">
		<fieldset>
			<legend>REGISTERED USERS LOGIN</legend>
			<?php if ($errors) 
			echo "<h2 class=\"warning\">PLEASE FIX THE ITEM(S) INDICATED.</h2>";

			if ($errors['email']) echo "<h2 class=\"warning\">{$errors['email']}</h2>"; 
			if ($errors['no_email']) echo "<h2 class=\"warning\">{$errors['no_email']}</h2>"; 
			?>
		 <p>	
			<label for="email">EMAIL: </label>
			<input name="email" id="email" type="text"
			<?php if (isset($email) &&!$errors['no_email']) {
				echo 'value="' . htmlspecialchars($email) . '"';
			} ?>>
		</p>
			<?php if ($errors['pw']) echo "<h2 class=\"warning\">{$errors['pw']}</h2>";    
				if ($errors['wrong_pw']) echo "<h2 class=\"warning\">{$errors['wrong_pw']}</h2>"; 
			?>
		<p>                    
			<label for="pw">PASSWORD: </label>
			<input name="password" id="pw" type="password">
		</p>
		<p>
			<input name="send" type="submit" value="SUBMIT">
		</p>
	</fieldset>
	</form>
<?php include './includes/footer.php'; ?>
