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
			<td colspan="6" style="font-size:14pt;font-weight:bold;padding:20px;text-align:center;">
				LISTADO DE FACTURAS - <?php echo User::model()->findByPK(Yii::app()->user->ID)->name; ?> - Del <?php echo $_POST["start"]; ?> al <?php echo $_POST["fin"]; ?>
			</td>
		</tr>
		<tr>
			<td class="title">Serie</td>
			<td class="title" align="center">Num.</td>
			<td class="title">Cliente</td>
			<td class="title">Importe</td>
			<td class="title">IVA</td>
			<td class="title">Total</td>
		</tr>
		
		<?php foreach($model as $invoice): ?>
		
		<tr>
			<td><?php echo $invoice->serie->Serie; ?></td>
			<td align="center"><?php echo $invoice->Number; ?></td>
			<td><?php echo $invoice->customer->FullName; ?></td>
			<?php
				$criteria = new CDbCriteria();
				$criteria->condition = "UserID = :userid AND InvoiceID = :invoiceid";
				$criteria->params = array(':userid' => Yii::app()->user->ID, ':invoiceid' => $invoice->ID);
				$modelCharges = Charge::model()->findAll($criteria);
				$importe = 0;
				$IVA = 0;
				$total = 0;
				foreach($modelCharges as $charge):
					$importe = $importe + $charge->Price;
					$IVA = $IVA + ($charge->Price * $charge->IVA) / 100;
				endforeach;
				$total = $importe + $IVA;
			?>
			<td><?php echo number_format($importe, 2,",","."); ?></td>
			<td><?php echo number_format($IVA, 2,",","."); ?></td>
			<td><?php echo number_format($total, 2,",","."); ?></td>
		</tr>
		<?php
			$importeTotal = $importeTotal + $importe;
			$IVATotal = $IVATotal + $IVA;
			$totalTotal = $totalTotal + $total;
		?>
		<?php endforeach; ?>
		
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td><?php echo number_format($importeTotal, 2,",","."); ?></td>
			<td><?php echo number_format($IVATotal, 2,",","."); ?></td>
			<td><?php echo number_format($totalTotal, 2,",","."); ?></td>
		</tr>
		
	</table>
</div>