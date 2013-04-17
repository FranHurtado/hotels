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
<div style='width:100%;'>
	<table width="100%" cellpadding="10">
		<tr>
			<td colspan="9" style="font-size:14pt;font-weight:bold;padding:20px;text-align:center;">
				LISTADO DE CLIENTES - <?php echo User::model()->findByPK(Yii::app()->user->ID)->name; ?>
			</td>
		</tr>
		<tr>
			<td>DNI</td>
			<td>Nombre</td>
			<td>Email</td>
			<td>Telefono</td>
			<td>Direccion</td>
		</tr>

		<?php foreach($model as $customer): ?>
		<tr>
			<td><?php echo $customer->DNI; ?></td>
			<td><?php echo $customer->FullName; ?></td>
			<td><?php echo $customer->Email; ?></td>
			<td><?php echo $customer->Phone; ?></td>
			<td><?php echo $customer->Address; ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>