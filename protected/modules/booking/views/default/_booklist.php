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
			<td colspan="5" style="font-size:14pt;font-weight:bold;padding:20px;text-align:center;">
				LISTADO DE RESERVAS - <?php echo User::model()->findByPK(Yii::app()->user->ID)->name; ?> - Del <?php echo $_POST["start"]; ?> al <?php echo $_POST["fin"]; ?>
			</td>
		</tr>
		<tr>
			<td class="title">Entrada</td>
			<td class="title">Salida</td>
			<td class="title">Cliente</td>
			<td class="title">Habitacion</td>
			<td class="title">Comentarios</td>
		</tr>
		
		<?php foreach($model as $book): ?>
		
		<tr>
			<td><?php echo $book->Start; ?></td>
			<td><?php echo $book->Finish; ?></td>
			<td><?php echo $book->customer->FullName; ?></td>
			<td><?php echo $book->room->Name; ?></td>
			<td><?php echo $book->Comment; ?></td>
		</tr>
		
		<?php endforeach; ?>
		
	</table>
</div>