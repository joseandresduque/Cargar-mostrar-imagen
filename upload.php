<?php
if(isset($_POST["submit"])){
    $nombreTemporal   = getimagesize($_FILES["image"]["tmp_name"]);
    $sizeImage        = $_FILES["image"]["size"];  
    $fileName         = basename($_FILES["image"]["name"]);//si le paso esto como nombre de archivo luego no lee bien al mostrarlo
    $tipo             = $_FILES["image"]["type"];
    $nombreArchivo    = pathinfo($_FILES["image"]["name"], PATHINFO_FILENAME); //regresa 'html'  
    $extensionArchivo = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION); //regresa 'index' 
    
    $mensaje;
    if($nombreTemporal !== false){
        /* otra forma de comprobar su extensión
        $allowTypes = array('jpg','png','jpeg','gif','pdf','pjpeg','bmp');
        if(in_array($tipo, $allowTypes)){
        */
        if ($tipo == "image/jpeg"  || 
            $tipo == "image/pjpeg" || 
            $tipo == "image/gif"   || 
            $tipo == "image/bmp"   || 
            $tipo == "image/png"){
            
            $image = $_FILES['image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));//lo paso a cadena de texto

            require("conexion.php");

            $dataTime = date("Y-m-d H:i:s");
            
            $insert = $db->query("INSERT into images (nombre, image, tipo, size, created) VALUES ('$nombreArchivo', '$imgContent', '$tipo', '$sizeImage','$dataTime')");

            if($insert){
                $mensaje = "Archivo subido.  ".$nombreArchivo;
            }else{ 
                $mensaje = "File upload failed, please try again.  ".$nombreArchivo;
            }
            $db->close();
        }else{
            echo "<div class='error'>Error: El formato de archivo tiene que ser JPG, GIF, BMP o PNG.</div>";
        }
    }else{
        $mensaje = "Please select an image file to upload.  ".$nombreArchivo;
    }  
    header("Location:".$_SERVER['HTTP_REFERER']."?mensaje=".$mensaje);       
}
?>