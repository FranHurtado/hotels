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
	<table width="100%">
		<tr>
			<td colspan="4" style="font-size:14pt;font-weight:bold;padding:20px;text-align:center;">
				FICHA: <?php echo $model->Name; ?>
			</td>
		</tr>
		<tr>
			<td><b>Nombre del control:</b></td><td><?php echo $model->Name; ?></td>
			<td><b>Punto critico:</b></td><td><?php echo $model->point->Name; ?></td>
		</tr>
		<tr>
			<td><b>Fecha de comienzo:</b></td><td><?php echo date("d/m/Y", strtotime($model->Startdate)); ?></td>
			<td><b>Fecha de finalizacion:</b></td><td><?php echo date("d/m/Y", strtotime($model->Enddate)); ?></td>
		</tr>
		<tr>
			<td><b>Empleado:</b></td><td><?php echo $model->worker->Fullname; ?></td>
			<td><b>Frecuencia:</b></td><td><?php echo Control::model()->giveFrecuency($model->Frecuency); ?></td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4"><b>Tarea:</b></td>
		</tr>
		<tr>
			<td colspan="4"><?php echo $model->Task; ?></td>
		</tr>
	</table><br /><br /><br />
	
	<table width="35%">
		<tr>
			<td><b>Firma del responsable:</b></td>
		</tr>
		<tr>
			<td><br /><br /><br /><br /><br /><br /></td>
		</tr>
	</table>
</div>