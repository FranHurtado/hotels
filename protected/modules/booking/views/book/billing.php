<?php
/* @var $this BookController */
/* @var $model Book */

$this->breadcrumbs=array(
	'Reservas'=>array('admin'),
	'Facturacion',
);

$this->menu=array(
	array('label'=>'Planning de reservas', 'url'=>array('planning')),
	array('label'=>'Nueva Reserva', 'url'=>array('create')),
	array('label'=>'Listado Reservas', 'url'=>array('admin')),
	array('label'=>'Nueva Habitacion', 'url'=>array('/booking/room/create')),
	array('label'=>'Listado Habitaciones', 'url'=>array('/booking/room/admin')),
	array('label'=>'Nueva Temporada', 'url'=>array('/booking/season/create')),
	array('label'=>'Listado Temporadas', 'url'=>array('/booking/season/admin')),
);
?>

<div style="width:80%;padding: 20px;">

<table cellspacing="0" style="border: 1px solid #333;">

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

<table cellspacing="0" class="borderer conceptos">

	<tr><td colspan="2" class="supertitle">Conceptos</td></tr>
	
	<tr>
		<td class="title" style="width: 80%;">Detalle</td>
		<td class="title" style="text-align: center; width: 20%;">Precio</td>
	</tr>
		
	<?php foreach($items as $item): ?>
		<tr>
			<td class="content"><?php echo $item[1]; ?></td>
			<td class="content" style="text-align: center;"><?php echo str_replace('.',',',$item[0]); ?></td>
		</tr>
		
		<?php $total = $total + $item[0]; ?>
		
		<?php
			$iva = $iva + (($item[0] * User::model()->findByPK(Yii::app()->user->ID)->IVA/100));
		?>
		
		
	<?php endforeach; ?>

</table><br />

<table cellspacing="0" class="borderer total">
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

<div class="row buttons">
	<?php echo CHtml::button('Generar', array('id'=>'btnGenerar')); ?> &nbsp;&nbsp;
	<?php echo CHtml::button('Generar e imprimir', array('id'=>'btnImprimir')); ?>
</div>

</div>

<script>
	$(document).ready(function(){
		$("#btnGenerar").click(function(){
			window.location = "<?php echo Yii::app()->createURL('booking/book/generate/', array('id'=>$model->ID)); ?>";
		});
		$("#btnImprimir").click(function(){
			window.location = "<?php echo Yii::app()->createURL('booking/book/generateprint/', array('id'=>$model->ID)); ?>";
		});
	});
</script>