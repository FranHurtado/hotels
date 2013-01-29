<?php
	$dias= (strtotime($_POST["start"])-strtotime($_POST["fin"]))/86400;
	$dias = abs($dias); $dias = floor($dias);
?>

<div style='width:100%;'>
	<table width="100%" cellpadding="10">
		<tr>
			<td colspan="6" style="font-size:14pt;font-weight:bold;padding:20px;text-align:center;">
				FICHA DE CONTROL DE LIMPIEZA Y DESINFECCION
			</td>
		</tr>
		<tr>
			<td>Fecha</td>
			<td>Superficie</td>
			<td>Metodo y materiales</td>
			<td>Eficacia de la limpieza</td>
			<td>Empleado</td>
			<td>Medida correctora</td>
			<td>Firma responsable</td>
		</tr>
		<?php for($i=0;$i<$dias;$i++): ?>
		<?php
			$newFecha = strtotime($_POST["start"]) + ($i * 86400);	
			$Worker = Worker::model()->findByAttributes(array("UserID"=>Yii::app()->user->ID));
		?>
			<tr>
				<td><?php echo date("d-m-Y", $newFecha); ?></td>
				<td>Suelos</td>
				<td>Fregado con detergente</td>
				<td>OK</td>
				<td><?php echo $Worker->Fullname; ?></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><?php echo date("d-m-Y", $newFecha); ?></td>
				<td>Encimeras</td>
				<td>Limpiado con bayeta y producto recomendado</td>
				<td>OK</td>
				<td><?php echo $Worker->Fullname; ?></td>
				<td></td>
				<td></td>
			</tr>
		<?php endfor; ?>
	</table>
</div>