<?php
	$dias= (strtotime($_POST["start"])-strtotime($_POST["fin"]))/86400;
	$dias = abs($dias); $dias = floor($dias);
?>

<div style='width:100%;'>
	<table width="100%" cellpadding="10">
		<tr>
			<td colspan="11" style="font-size:14pt;font-weight:bold;padding:20px;text-align:center;">
				FICHA DE CONTROL DE DESINSECCION Y DESRATIZACION
			</td>
		</tr>
		<tr>
			<td colspan="4" style="font-size:11pt;font-weight:bold;padding:10px20px;text-align:center;background:#dedede;">
				CEBOS
			</td>
			<td colspan="7" style="font-size:11pt;font-weight:bold;padding:10px20px;text-align:center;background:#dedede;">
				TRAMPAS
			</td>
		</tr>
		<tr>
			<td>Fecha</td>
			<td>Num</td>
			<td>Comido</td>
			<td>Observaciones</td>
			<td>Num</td>
			<td>Tipo</td>
			<td>Funciona</td>
			<td>Captura</td>
			<td>Observaciones</td>
			<td>Medida Correctora</td>
			<td>Firma Responsable</td>
		</tr>
		<?php for($i=0;$i<$dias;$i++): ?>
		<?php
			$newFecha = strtotime($_POST["start"]) + ($i * 86400);	
		?>
			<?php for($j=1;$j<=User::model()->findByPK(Yii::app()->user->ID)->cebos;$j++): ?>
			<tr>
				<td><?php echo date("d-m-Y", $newFecha); ?></td>
				<td><?php echo $j; ?></td>
				<td>NO</td>
				<td>Todo OK</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php endfor; ?>
			
			<?php for($k=1;$k<=User::model()->findByPK(Yii::app()->user->ID)->cebos;$k++): ?>
			<tr>
				<td><?php echo date("d-m-Y", $newFecha); ?></td>
				<td></td>
				<td></td>
				<td></td>
				<td><?php echo $k; ?></td>
				<td>Cepo</td>
				<td>SI</td>
				<td>NO</td>
				<td>Todo OK</td>
				<td></td>
				<td></td>
			</tr>
			<?php endfor; ?>
		<?php endfor; ?>
	</table>
</div>