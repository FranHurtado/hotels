<?php
	$dias= (strtotime($_POST["start"])-strtotime($_POST["fin"]))/86400;
	$dias = abs($dias); $dias = floor($dias);
?>

<div style='width:100%;'>
	<table width="100%" cellpadding="10">
		<tr>
			<td colspan="9" style="font-size:14pt;font-weight:bold;padding:20px;text-align:center;">
				FICHA DE CONTROL DE ALMACEN Y CAMARAS
			</td>
		</tr>
		<tr>
			<td>Fecha</td>
			<td>Camara</td>
			<td>No caducados</td>
			<td>Productos aislados del suelo</td>
			<td>Separacion crudos y elaborados</td>
			<td>Elaborados tapados</td>
			<td>Estiba correcta</td>
			<td>Medida correctora</td>
			<td>Firma Responsable</td>
		</tr>
		<?php for($i=1;$i<=$dias;$i++): ?>
		<?php
			$newFecha = strtotime($_POST["start"]) + ($i * 86400);	
		?>
			<?php for($j=1;$j<=User::model()->findByPK(Yii::app()->user->ID)->camaras;$j++): ?>
			<tr>
				<td><?php echo date("d-m-Y", $newFecha); ?></td>
				<td>C&aacute;mara <?php echo $j; ?></td>
				<td>OK</td>
				<td>OK</td>
				<td>OK</td>
				<td>OK</td>
				<td>OK</td>
				<td></td>
				<td></td>
			</tr>
			<?php endfor; ?>
		<?php endfor; ?>
	</table>
</div>