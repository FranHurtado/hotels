<?php
	$dias= (strtotime($_POST["start"])-strtotime($_POST["fin"]))/86400;
	$dias = abs($dias); $dias = floor($dias);
	
	$randomHour = "0" . rand(8,11) . ":" . rand(10,58);
?>

<div style='width:100%;'>
	<table width="100%" cellpadding="10">
		<tr>
			<td colspan="7" style="font-size:14pt;font-weight:bold;padding:20px;text-align:center;">
				FICHA DE CONTROL DE CLORO
			</td>
		</tr>
		<tr>
			<td>Fecha y hora</td>
			<td>Punto de muestreo</td>
			<td>Nivel>0.2ppm</td>
			<td>Causa incorrecion</td>
			<td>Medida correctora</td>
			<td>Firma Responsable</td>
		</tr>
		<?php for($i=1;$i<=$dias;$i++): ?>
		<?php
			$newFecha = strtotime($_POST["start"]) + ($i * 86400);	
		?>
			<tr>
				<td><?php echo date("d-m-Y", $newFecha) . " " . $randomHour; ?></td>
				<td>Grifo cocina</td>
				<td><?php echo (rand(23, 42) / 100); ?></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><?php echo date("d-m-Y", $newFecha) . " " . $randomHour; ?></td>
				<td>Grifo barra</td>
				<td><?php echo (rand(23, 42) / 100); ?></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><?php echo date("d-m-Y", $newFecha) . " " . $randomHour; ?></td>
				<td>Grifo lavabos</td>
				<td><?php echo (rand(26, 31) / 100); ?></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		<?php endfor; ?>
	</table>
</div>