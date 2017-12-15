<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require("conexion.php");
    $id =  $_POST["id"];
 
    $result = $db->query("SELECT image FROM images WHERE id =".$id);
    
    if($result->num_rows > 0){
        $imgData = $result->fetch_assoc();
        $imagen = $imgData['image'];
        header("Content-type: image/jpg");
        echo '<img src="data:image/x-icon;base64,'.base64_encode($imagen).'"/>';
    }else{
        echo 'Imágen no encontrada...';
    }
}
?>