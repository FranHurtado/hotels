<?php
/* @var $this WorkerController */
/* @var $model Worker */


$this->menu=array(
	array('label'=>'Nuevo Operario', 'url'=>array('create')),
);

$this->help = "- Para crear un nuevo operario pulsa el bot&oacute;n \"Nuevo operario\".<br /><br />
			   - Puede realizar busquedas escribiendo en las cabeceras de los campos."; 

?>

<h1>Listado de operarios</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'worker-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'hideHeader'=>true,
	'columns'=>array(
		'Fullname',
		array(	
	        'class'=>'CButtonColumn',
	        'template'=>'{update} {delete}',
	        'buttons' => array(
	            'update' => array(
	            	'label' => 'Editar',
	            	'imageUrl' => false,
	            ),
	            'delete' => array(
	            	'label' => 'Borrar',
	                'imageUrl' => false,
	            ),
	        ),
	        'deleteConfirmation'=>'Si aceptas eliminaras este registro definitivamente.',
	     ),
	),
	'emptyText' => 'No hay registros.',
    'summaryText' => 'Mostrando del {start} al {end} de {count} registro(s).',
)); ?>

<?php
	$dp = $model->search();
	if($dp->totalItemCount == 0){ ?> <script>$(".filters").hide();</script> <?php }
?>

<a href="<?php echo Yii::app()->createURL("APPC"); ?>" class="backButton">Men&uacute;</a>
