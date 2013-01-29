<?php
/* @var $this DefaultController */

?>

<div class="contentbox" id="mainmenu" style="width:700px;">
	
	<div class="titleV">
		<h1>Men&uacute; de APPC</h1>
	</div>
	
	<div id="menu">
		<div class="buttonA"><p><a href="<?php echo Yii::app()->createURL("APPC/point"); ?>">Puntos Cr&iacute;ticos</a></p></div>
		<div class="buttonA"><p><a href="<?php echo Yii::app()->createURL("APPC/control"); ?>">Controles</a></p></div>
		<div class="buttonA"><p><a href="<?php echo Yii::app()->createURL("APPC/default/informe"); ?>">Informes</a></p></div>
		<div class="clear"></div>
	</div>

</div>

<br /><br />

<p style="text-align: center;">
	<img src="<?php echo Yii::app()->baseUrl; ?>/images/pasos_appc.jpg" align="center" style="border: 2px solid white;" />
</p>

<a href="<?php echo Yii::app()->createURL("./"); ?>" class="backButtonA">Volver</a>