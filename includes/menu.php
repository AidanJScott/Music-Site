<?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); ?>
<nav>
    <ul>
        <li id="home"><a href="index.php" <?php if ($currentPage == 'index.php') {echo 'id="current"'; } ?>>HOME</a></li>
        <li id="listen">LISTEN ˅
            <ul>
                <li><a href="ajei.php" <?php if ($currentPage == 'ajei.php') {echo 'id="current"'; } ?>>AJEI</a></li>
                <li><a href="infinxty.php" <?php if ($currentPage == 'infinxty.php') {echo 'id="current"'; } ?>>INFINXTY</a></li>
            </ul>
        </li>
        <li id="shop"><a href="shop.php" <?php if ($currentPage == 'shop.php') {echo 'id="current"'; } ?>>SHOP</a></li>
        <?php
		if(isset($_SESSION['first_name']) AND isset($_SESSION['email'])){
			echo "<li><a href=\"loggedOut.php\""; 
			if ($currentPage == 'loggedOut.php') {echo 'id="here"'; }
			echo ">LOG OUT</a></li>";
		}
		else {
            echo "<li id=\"join\">JOIN ˅";
            echo "<ul>";
			echo "<li><a href=\"join.php\""; 
			if ($currentPage == 'join.php') {echo 'id="here"'; }
			echo ">REGISTER</a></li>";
			echo "<li><a href=\"login.php\""; 
			if ($currentPage == 'login.php') {echo 'id="here"'; }
			echo ">LOG IN</a></li>";
            echo "</ul>";
            echo "</li>";
		}
		?>
    </ul>
</nav>