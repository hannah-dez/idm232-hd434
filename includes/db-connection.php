<?php
    $host = 'localhost';
    $user = 'hd434';
    $password = 'xn9Went8n3+GB5yD';
    $database = 'hd434_db';
    $connection = mysqli_connect($host, $user, $password, $database);
    if(!$connection){
        die("Connection failed: " . mysqli_connect_error());
    }
?>