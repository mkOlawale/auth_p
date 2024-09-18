<?php 
    $email = $password = '';
    session_start();
    if(isset($_SESSION["res"])){
        header('Location: Dashboard.php');
        die();
    }

?>
<?php include('partial/header.php'); ?>
<br> <br>
<div class="form-container"> 
        <h2>Login to Your Account</h2>
        <p>
            <?php
                if(isset($_POST['submit'])){
                     $email = $_POST['email'];
                     $password = $_POST['password'];

                     require_once "config/db_connect.php";
                     $sql = "SELECT * FROM user WHERE email = '$email'";
                     $querry = mysqli_query($conn, $sql);
                     $res = mysqli_fetch_array($querry, MYSQLI_ASSOC);
                     if($res){
                        if(password_verify($password, $res['password'])){
                           session_start();
                           $_SESSION["res"] = 'yes';
                            header('Location: Dashboard.php');
                        }else{
                               echo "<div class='danger'>The Password did not match our record</div>";
                        }
                     }else{
                        echo "<div class='danger'>The email does not exit</div>";
                     }
                }
            ?>
        </p>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email);?>" placeholder="Enter your email">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password " value="<?php echo htmlspecialchars($password);?>"/>
            </div>
            <div class="input-group">
                <button type="submit" name="submit">Register</button>
            </div>
        </form>
       <p>
          Not Sign up yet <b> <a href="Register.php">Sign Up</a> </b>
       </p> 
    </div>
</body>
</html>