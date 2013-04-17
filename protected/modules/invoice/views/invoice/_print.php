<style>
	table
{
	border-collapse: collapse;
}

table td
{
	padding: 10px;
}

table .supertitle
{
	font-size: 16pt;
	font-weight: bold;
	text-align: left;
}

table .title
{
	width: 10%;
	font-size: 11pt;
	font-weight: bold;
	text-align: left;
}

table .content
{
	font-size: 10pt;
	font-weight: normal;
	text-align: left;
}

table.borderer td
{
	border: 1px solid #333;
	padding: 10px;
}

</style>

<table cellspacing="0" cellpadding="8" style="border: 1px solid #333;width:100%;">

	<tr><td colspan="2" class="supertitle">Datos del cliente</td><td colspan="2" class="supertitle">Datos establecimiento</td></tr>
	
	<tr>
		<td class="title">DNI/NIF: </td><td class="content"><?php echo $model->customer->DNI; ?></td>
		<td class="title">DNI/NIF: </td><td class="content"><?php echo $model->user->DNI; ?></td>
	</tr>
	
	<tr>
		<td class="title">Nombre: </td><td class="content"><?php echo $model->customer->FullName; ?></td>
		<td class="title">Nombre: </td><td class="content"><?php echo $model->user->name; ?></td>
	</tr>
	
	<tr>
		<td class="title">Direcci&oacute;n: </td><td class="content"><?php echo $model->customer->Address; ?></td>
		<td class="title">Direcci&oacute;n: </td><td class="content"><?php echo $model->user->address; ?></td>
	</tr>

</table><br />

<table cellspacing="0" cellpadding="8" class="borderer conceptos" style="border: 1px solid #333;width:100%;">

	<tr><td colspan="2" class="supertitle">Conceptos</td></tr>
	
	<tr>
		<td class="title" style="width: 80%;">Detalle</td>
		<td class="title" style="text-align: center; width: 20%;">Precio</td>
	</tr>
		
	<?php foreach($modelCharges as $item): ?>
		<tr>
			<td class="content"><?php echo $item->Text; ?></td>
			<td class="content" style="text-align: center;"><?php echo str_replace('.',',',$item->Price); ?></td>
		</tr>
		
		<?php $total = $total + $item->Price; ?>
		
		<?php
			$iva = $iva + (($item->Price * $item->IVA)/100);
		?>
		
		
	<?php endforeach; ?>

</table><br />

<table cellspacing="0" cellpadding="8" class="borderer total" style="border: 1px solid #333;width:100%;">
	<tr>
		<td class="title" style="text-align: right; width: 80%;">IVA: </td>
		<td class="content" style="text-align: center; width: 20%;">
			<?php echo number_format($iva, 2); ?>
		</td>
	</tr>
	
	<tr>
		<td class="title" style="text-align: right; width: 80%;">TOTAL: </td>
		<td class="content" style="text-align: center; width: 20%; font-size: 14pt;">
			<?php echo number_format($total + $iva, 2); ?>&euro;
		</td>
	</tr>

</table><br />