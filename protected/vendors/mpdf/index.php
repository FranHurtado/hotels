<?php
/* @var $this DefaultController */
?>

<div class="contentbox" id="mainmenu" style="width:700px;">
	
	<div class="title">
		<h1>Men&uacute; de Trazabilidad</h1>
	</div>
	
	<div id="menu">
		<div class="button"><p><a href="<?php echo Yii::app()->createURL("Trazabilidad/worker"); ?>">Proveedores</a></p></div>
		<div class="button"><p><a href="#">Materias Primas</a></p></div>
		<div class="button"><p><a href="#">Productos</a></p></div>
		<div class="button"><p><a href="#">Recetas</a></p></div>
		<div class="button"><p><a href="#">Operarios</a></p></div>
		<div class="clear"></div>
	</div>

</div>

<a href="<?php echo Yii::app()->user->returnURL; ?>" class="backButton">Volver</a>