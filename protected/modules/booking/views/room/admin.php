<?php
/* @var $this RoomController */
/* @var $model Room */

$this->breadcrumbs=array(
	'Habitaciones'=>array('admin'),
	'Listado',
);

$this->menu=array(
	array('label'=>'Planning de reservas', 'url'=>array('/booking/book/planning')),
	array('label'=>'Nueva Reserva', 'url'=>array('/booking/book/create')),
	array('label'=>'Listado Reservas', 'url'=>array('/booking/book/admin')),
	array('label'=>'Nueva Habitacion', 'url'=>array('/booking/room/create')),
	array('label'=>'Nueva Temporada', 'url'=>array('/booking/season/create')),
	array('label'=>'Listado Temporadas', 'url'=>array('/booking/season/admin')),
);

?>

<h1 class="header">Listado de habitaciones</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'room-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=> 'Name',
            'filter'=> CHtml::activeTextField($model, 'Name', 
                 			array('placeholder'=>'Escribe el valor a buscar...')),
            'headerHtmlOptions'=>array(
                'style'=>'width:50%;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:50%;text-align:left;',
            ),
        ),
        array(
			'name'=>'PriceBig',
			'filter'=>false,
		),
		array(
			'name'=>'PriceMed',
			'filter'=>false,
		),
		array(
			'name'=>'PriceLow',
			'filter'=>false,
		),
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
