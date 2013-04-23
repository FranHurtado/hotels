<style>
table
{
	border-collapse: collapse;
}

table td
{
	border: 1px solid #333;
	padding: 10px;
}
</style>

<?php
	$dias= (strtotime($_POST["start"])-strtotime($_POST["fin"]))/86400;
	$dias = abs($dias); $dias = floor($dias);
?>

<div style='width:100%;'>
	<table width="100%" cellpadding="10">
		<tr>
			<td colspan="6" style="font-size:14pt;font-weight:bold;padding:20px;text-align:center;">
				FICHA DE CONTROL DE TEMPERATURAS
			</td>
		</tr>
		<tr>
			<td>Fecha/Hora</td>
			<td>T. Frigorifico</td>
			<td>T. Congelador</td>
			<td>T. Cocina</td>
			<td>Medida Correctora</td>
			<td>Firma Responsable</td>
		</tr>
		<?php for($i=0;$i<$dias;$i++): ?>
		<?php
			$newFecha = strtotime($_POST["start"]) + ($i * 86400);	
		?>
		<tr>
			<td><?php echo date("d-m-Y", $newFecha); ?></td>
			<td><?php echo (rand(21, 42) / 10); ?></td>
			<td><?php echo (rand(-205, -187) / 10); ?></td>
			<td><?php echo rand(25, 21); ?></td>
			<td></td>
			<td></td>
		</tr>
		<?php endfor; ?>
	</table>
</div>