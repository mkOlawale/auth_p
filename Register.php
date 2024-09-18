<?php 
    session_start();
    if(isset($_SESSION["res"])){
        header('Location: Dashboard.php');
        die();
    }

?>
<?php include('partial/header.php'); ?>
<br>
<div class="form-container">
        <h2>Register Your Accounts</h2>
        <!-- <p class="danger"> -->
            <?php
            include('config/db_connect.php');
                if(isset($_POST['submit'])){
                   
                     $fullname = $_POST['fullname'];
                     $email = $_POST['email'];
                     $password = $_POST['password'];
                     $retype_password = $_POST['retype_password'];

                     $password_hass = password_hash($password, PASSWORD_DEFAULT);
                     $errors = array();

                     if(empty($fullname) OR empty($email) OR empty($password) OR empty($retype_password)){
                        array_push($errors, "All field is required");
                     }
                     if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        array_push($errors, "Valid email address is required");
                     } 
                     if($password !== $retype_password){
                        array_push($errors, "Password must be the same");
                     }
                     require_once "config/db_connect.php";
                     $sql = "SELECT * FROM user WHERE email = '$email'";
                     $res = mysqli_query($conn, $sql);
                     $resCount = mysqli_num_rows($res);
                     if($resCount > 0){
                        array_push($errors, "Email address is already Exist");
                     };
                     if(count($errors) > 0){
                            foreach($errors as $e){
                                echo "<p class='danger'>$e</p>";
                            }
                     }else{
                        require_once "config/db_connect.php";
                            $sql = "INSERT INTO user(fullname, email, password) VALUES(?, ?, ?)";

                            $stnt = mysqli_stmt_init($conn);
                            $prepare = mysqli_stmt_prepare($stnt, $sql);

                            if($prepare){
                                mysqli_stmt_bind_param($stnt, "sss", $fullname, $email, $password_hass);
                                mysqli_stmt_execute($stnt);

                                echo "<div style='color: green;'>You have registered succesfully</div>";
                            }else{
                                die("Something is wrong with the connection");
                            }
                     }

                }
            ?>
        <!-- </p> -->
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <div class="input-group">
                <label for="title">Your Fullname</label>
                <input type="text" id="fullname" name="fullname" placeholder="Enter recipe title">
              
            </div>
            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="text" id="email" name="email" placeholder="Enter your email">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password " />
          
            </div>
            <div class="input-group">
                <label for="password">Retype Password</label>
                <input type="password" id="password" name="retype_password" placeholder="Re-type your password" />
          
            </div>
            <div class="input-group">
                <button type="submit" name="submit">Register</button>
            </div>
        </form>
        <p>
          Already have an account?<b><a href="Login.php">Sign in</a> </b>
       </p> 
    </div>
</body>
</html>