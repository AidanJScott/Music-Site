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
        <li id="join"><a href="join.php" <?php if ($currentPage == 'join.php') {echo 'id="current"'; } ?>>JOIN</a></li>
    </ul>
</nav>