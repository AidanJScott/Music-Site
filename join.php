<?php 
// Aidan Scott
require "includes/header.php";
?>
<main>
    <h2>REGISTER FOR EMAIL LIST</h2>
    <?php
    if (isset($_GET['submit'])&& $_GET['submit'] == "SUBSCRIBE" ) {
        if (!empty($_GET['name'])){
            $name = trim($_GET['name']);
        }
        else {
            $missing['name'] = "A NAME IS REQUIRED: ";
        }
        if (!empty($_GET['email'])){
            $email = trim($_GET['email']);
        }
        else {
            $missing['email'] = "AN EMAIL IS REQUIRED: ";
        }
        if (!empty($_GET['password'])){
            $password = trim($_GET['password']);
        }
        else {
            $missing['password'] = "A PASSWORD IS REQUIRED: ";
        }
        if (!empty($_GET['password_check'])){
            $password_check = trim($_GET['password_check']);
        }
        else {
            $missing['password_check'] = "A PASSWORD IS REQUIRED: ";
        }
        if ($password != $password_check){
            $missing['password_check'] = "PASSWORDS MUST MATCH: ";
        }
        if (empty($missing)){
            echo "<h2>THANK YOU FOR SUBSCRIBING</h2>";
            include "includes/footer.php";
            exit;
        }
    }
    ?>
    <form>
        <?php 
            if (isset($missing)) 
            echo '<h3 class="warning">Please correct the following: </h3>';
        ?>
        <p>
        <?php 
            if (isset($missing['name'])) 
                echo '<span class="warning">'.$missing['name'].'</span><br>'; 
        ?>
            <label>NAME: 
            <input type="text" name="name" id="name"
            <?php if (isset($name)) echo 'value="'.htmlspecialchars($name).'"';?>
            >
            </label>
        </p>
        <p>
        <?php 
            if (isset($missing['email'])) 
                echo '<span class="warning">'.$missing['email'].'</span><br>'; 
        ?>
            <label>EMAIL: 
            <input type="email" name="email" id="Email"
            <?php if (isset($email)) echo 'value="'.htmlspecialchars($email).'"';?>
            >
            </label>
        </p>
        <p>
            <?php 
                if (isset($missing['password'])) 
                    echo '<span class="warning">'.$missing['password'].'</span><br>'; 
            ?>
            <label>PASSWORD: 
            <input type="password" name="password" id="Password">
            </label>
        </p>
        <p>
            <?php 
                if (isset($missing['password_check'])) 
                    echo '<span class="warning">'.$missing['password_check'].'</span><br>'; 
            ?>
            <label>RE-ENTER PASSWORD: 
            <input type="password" name="password_check" id="Password Check">
            </label>
        </p>
        <p>
            <input type="submit" name="submit" value="SUBSCRIBE">
        </p>
    </form>
    <hr>
</main>
<?php include "includes/footer.php"; ?>