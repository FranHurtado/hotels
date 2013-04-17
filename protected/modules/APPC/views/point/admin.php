<?php
/* @var $this PointController */
/* @var $model Point */

$this->breadcrumbs=array(
	'Puntos cr&iacute;ticos'=>array('admin'),
	'Listado',
);

$this->menu=array(
	array('label'=>'Nuevo Punto Critico', 'url'=>array('create')),
	array('label'=>'Nuevo Control', 'url'=>array('control/create')),
	array('label'=>'Nuevo Trabajador', 'url'=>array('worker/create')),
	array('label'=>'Listado Controles', 'url'=>array('control/admin')),
	array('label'=>'Listado Trabajadores', 'url'=>array('worker/admin')),
);

$this->help='La aplicaci&oacute;n genera un informe de APPC autom&aacute;tico con los puntos cr&iacute;ticos recomendados. 
				Si usted lo desea puede a&ntilde;adir alguno m&aacute;s personalizado a dicha lista.';

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
	'emptyText' => 'No hay registros. <a href="'.$this->createURL('create').'">Picha</a> para crear uno.',
    'summaryText' => 'Mostrando del {start} al {end} de {count} registro(s).',
)); ?>
