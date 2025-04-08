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
        
        try{
            // connect to database
            require_once '../../pdo_connect.php';

            //Check to see if email address already exists
            $sql = "SELECT * FROM music_site_users WHERE email = ?";
            $stmt = $dbc->prepare($sql);
            $stmt->bindParam(1, $email);
            $stmt->execute();
            $numRows = $stmt->rowCount();
            if ($numRows >= 1)
                $missing['exists'] = "That email address is already registered.";
            
            // insert into database if no errors are found
            if (empty($missing)){
                $sql2 = "INSERT INTO music_site_users (name, email, password) VALUES (?, ?, ?)";
                $stmt2 = $dbc->prepare($sql2);
                $pw_hash= password_hash($password, PASSWORD_DEFAULT);
                $stmt2->bindParam(1, $name);
                $stmt2->bindParam(2, $email);
                $stmt2->bindParam(3, $pw_hash);
                $stmt2->execute();
                $numRows = $stmt2->rowCount();
                if ($numRows != 1)
                    echo "<h2>We are unable to process your request at  this  time. Please try again later.</h2>";
                else 
                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    header('Location: acct_created.php');
                include 'includes/footer.php'; 
                exit;      
            }
        }
        catch (PDOException $e){
            echo $e->getMessage();	
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
            if (isset($missing['exists']))
                echo '<span class="warning">'.$missing['exists'].'</span><br>'; 
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