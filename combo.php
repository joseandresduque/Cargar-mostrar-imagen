<?php
    require("conexion.php");
    
    //Create connection and select DB
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    
    //Check connection
    if($db->connect_error){
       die("Connection failed: " . $db->connect_error);
    }
    
    //Get image data from database
    //$result = $db->query("SELECT image FROM images WHERE id = {$_GET['id']}");
    $result = $db->query("SELECT id, nombre FROM images order by nombre");
    $imagenes[]  = array();
    if($result->num_rows > 0){
        while($imgData = $result->fetch_assoc()){
           // echo $imgData['id'];
            //Render image
            //header("Content-type: image/jpg"); 
            $imagenes[] = $imgData; 
        }
    }else{
        return 'Image not found...';
    }
    return $imagenes;
?>