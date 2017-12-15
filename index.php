<?php
error_reporting(E_ALL ^ E_NOTICE);
require('combo.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="image"/>
        <input type="submit" name="submit" value="UPLOAD"/>
    </form>
		<br/>
	<!--<form action=" echo htmlentities($_SERVER['PHP_SELF']);" method="post">-->
		<form action="#" method="post"id="formulario">
		<select id="selectImagen" class="form-control" name="id">
			<?php 
				if(!empty($imagenes)){
					$seleccionado = false;
					foreach($imagenes as $row){
						if(!$seleccionado){
							$seleccionado = true;
						}else{
							echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
						}
					} 
				}
			?>
		</select>
		<input id="btnShowImage" type="button" name="imagenes" value="VER"/>
	</form>
	<br/>
	<div id="mensaje">
		<?php
			if(!empty($_GET["mensaje"])){
				echo "<p>".$_GET["mensaje"]."</p>";
			}
		?>
	</div>
	<div id="mostrarImagen">

	</div>
	<script>
$(document).ready(function(){
	$("#btnShowImage").click(function () {
			var selectImagen = document.getElementById("selectImagen");
        	var idImagen = selectImagen.options[selectImagen.selectedIndex].value;

			var parametros = idImagen;

			var request = $.ajax({
				url: 'view.php',
				type: "POST",
				data: $("#formulario").serialize(), 
			});
            request.done(function (respuesta) {
				$("#mostrarImagen").html(respuesta);
            });
            request.fail(function (xhr, textStatus, errorThrown) {
                var mensajeError =        "errorThrown: " + JSON.stringify(errorThrown) +
                                    "\n xhr.readyState: " + JSON.stringify(xhr.readyState) +
                                  "\n xhr.responseText: " + JSON.stringify(xhr.responseText) +
                                        "\n xhr.status: " + JSON.stringify(xhr.status) +
                                    "\n xhr.statusText: " + JSON.stringify(xhr.statusText) +
                                        "\n textStatus: " + JSON.stringify(textStatus);
                console.log(mensajeError);
            });    
	});
});
</script>
</body>
</html>