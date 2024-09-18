<?php 

    session_start();
    if(!isset($_SESSION["res"])){
        header('Location: login.php');
    }


?>
    <div>
            <h1>Hi darling welcome to your dashboard</h1>
            <div>
                Click Here to <a href="logout.php">Logout from your account</a>
            </div>
    </div>

