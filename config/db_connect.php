<?php 
    $localhost = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "test";

    $conn = mysqli_connect($localhost, $db_username, $db_password, $db_name);

    if(!$conn){
        // echo "Something is wrong with the connection" . mysqli_error();
        die("Something is wrong with the connection");
    }

?>