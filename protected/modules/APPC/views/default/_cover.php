<div style='width:100%;text-align:center;font-size:36pt;position:absolute;top:300px;'>
	Informe Analisis Puntos Criticos
</div>
<div style='width:100%;text-align:left;font-size:12pt;position:absolute;top:650px;left:30px;'>
	<b>Nombre:</b> <?php echo User::model()->findByPK(Yii::app()->user->ID)->name; ?>
</div>
<div style='width:100%;text-align:left;font-size:12pt;position:absolute;top:680px;left:30px;'>
 	<b>Fecha del informe:</b> Del <?php echo date("d-m-Y", strtotime($_POST["start"])); ?> al <?php echo date("d-m-Y", strtotime($_POST["fin"])); ?>
</div>