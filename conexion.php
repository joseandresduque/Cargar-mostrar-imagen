<?php
//error_reporting(0);

    $dbHost     = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName     = 'imagenes';
      
     $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    
    if($db->connect_error){
       die("Connection failed: " . $db->connect_error);
    }
?>