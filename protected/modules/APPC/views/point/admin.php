<?php
/* @var $this PointController */
/* @var $model Point */

$this->breadcrumbs=array(
	'Puntos cr&iacute;ticos'=>array('admin'),
	'Listado',
);

$this->menu=array(
	array('label'=>'Crear Control', 'url'=>array('control/create')),
	array('label'=>'Crear Trabajador', 'url'=>array('worker/create')),
	array('label'=>'Crear Punto Critico', 'url'=>array('create')),
);

?>

<h1 class="header">Listado de puntos cr&iacute;ticos</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'point-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'Name',
		'Description',
	     array(	
	        'class'=>'CButtonColumn',
	        'template'=>'{update} {delete}',
	        'buttons' => array(
	            'update' => array(
	            	'label' => 'Editar',
	            	'imageUrl' => Yii::app()->baseURL . '/images/edit.png',
	            ),
	            'delete' => array(
	            	'label' => 'Borrar',
	                'imageUrl' => Yii::app()->baseURL . '/images/delete.png',
	            ),
	        ),
	        'deleteConfirmation'=>'Si aceptas eliminaras este registro definitivamente.',
	     ),
	),
	'emptyText' => 'No hay registros.',
    'summaryText' => 'Mostrando del {start} al {end} de {count} registro(s).',
)); ?>
