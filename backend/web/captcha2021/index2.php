<?php
/**
 * Formulario incompleto
 * Para CAPTCHA
 * Autor: Rodrigo Chambi Q.
 * Mail:  filvovmax@gmail.com
 * web:   www.gitmedio.com
 */
?>
<!DOCTYPE html>
		<html>
		<head>
			<title>sistema de login</title>
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
			<!-- vinculo a bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Temas-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="estilo.css">
		</head>
		<body>
		 <div id="Contenedor">
		 <div class="Icon"><span class="glyphicon glyphicon-user"></span></div>
		 <div class="ContentForm">
		 	<form action="" method="post" name="FormEntrar">
                <div class="input-group input-group-lg">
				 <span class="input-group-addon" id="sizing-addon1" style="padding-right:4px; padding-left:4px;"> <button style="margin-left: 0px;" type="button" class="btn btn-default btncapt"><i class="glyphicon glyphicon-refresh"></i></button> </span>
                      <!--<img src="capt.php" class="imct">-->
                    <!--Etiquita canvas para dibujar clave-->
				   <canvas id="capatcha"  style="width:100%;  border: 1px solid #ccc; float:left;  " height="62"></canvas>
				</div>
				<br>
				 <div class="input-group input-group-lg">
				 <span  class="input-group-addon" id="sizing-addon1" ><i class="glyphicon glyphicon-asterisk"></i></span>
				      <!--Caja de texto que permite introducir las clves-->
                      <input type="text" name="contra" id="valorCapt" class="form-control" placeholder="" aria-describedby="sizing-addon1" required>
				</div>
				<br>
				<button class="btn btn-lg btn-primary btn-block btn-signin" id="IngresoLog" type="button">Entrar</button>
				<!--<div class="opcioncontra"><a href="">Olvidaste tu contraseña?</a></div>-->
		 	</form>
		 </div>	
		 </div>
		</body>
		<!-- vinculando a libreria Jquery-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Libreria java scritp de bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="jsScript.js"></script>
		</html>		