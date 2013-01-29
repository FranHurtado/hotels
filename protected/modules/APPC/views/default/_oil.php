<?php
	$dias= (strtotime($_POST["start"])-strtotime($_POST["fin"]))/86400;
	$dias = abs($dias); $dias = floor($dias);
?>

<div style='width:100%;'>
	<table width="100%" cellpadding="10">
		<tr>
			<td colspan="7" style="font-size:14pt;font-weight:bold;padding:20px;text-align:center;">
				FICHA DE CONTROL DE RENOVACION DE ACEITES
			</td>
		</tr>
		<tr>
			<td>Fecha</td>
			<td>Freidora</td>
			<td>Volumen renovado</td>
			<td>Limpieza freidora</td>
			<td>Proxima revision</td>
			<td>Firma Responsable</td>
		</tr>
		<?php for($i=0;$i<$dias;$i++): ?>
		<?php
			$newFecha = strtotime($_POST["start"]) + ($i * 86400);	
		?>
			<?php for($j=1;$j<=User::model()->findByPK(Yii::app()->user->ID)->freidoras;$j++): ?>
			<tr>
				<td><?php echo date("d-m-Y", $newFecha); ?></td>
				<td>Freidora <?php echo date("d-m-Y", $i); ?></td>
				<td><?php echo (rand(42, 54) / 10); ?>l</td>
				<td>OK</td>
				<td>Ma&ntilde;ana en funcion del uso.</td>
				<td></td>
			</tr>
			<?php endfor; ?>
		<?php endfor; ?>
	</table>
</div>