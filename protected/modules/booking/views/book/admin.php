<?php
/* @var $this BookController */
/* @var $model Book */

$this->breadcrumbs=array(
	'Reservas'=>array('admin'),
	'Listado',
);

$this->menu=array(
	array('label'=>'Nueva Reserva', 'url'=>array('create')),
	array('label'=>'Planning Mensual', 'url'=>array('planning')),
	array('label'=>'Nueva Habitacion', 'url'=>array('/booking/room/create')),
	array('label'=>'Listado Habitaciones', 'url'=>array('/booking/room/admin')),
	array('label'=>'Nueva Temporada', 'url'=>array('/booking/season/create')),
	array('label'=>'Listado Temporadas', 'url'=>array('/booking/season/admin')),
);

?>

<h1 class="header">Listado de reservas</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'book-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate'=>"function(){
							jQuery('#date_start').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'dateFormat':'yy-mm-dd'}));
							jQuery('#date_finish').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'dateFormat':'yy-mm-dd'}));
						}",
	'columns'=>array(
		array(
            'name'=> 'CustomerID',
            'value' => '$data->customer->FullName',
	        'filter' => CHtml::listData(Customer::model()->findAll(), 'ID', 'FullName'),
            'headerHtmlOptions'=>array(
                'style'=>'width:40%;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:40%;text-align:left;',
            ),
        ),
        array(
            'name'=> 'RoomID',
            'value' => '$data->room->Name',
	        'filter' => CHtml::listData(Room::model()->findAll(), 'ID', 'Name'),
            'headerHtmlOptions'=>array(
                'style'=>'width:25%;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:25%;text-align:left;',
            ),
        ),
        array('name' => 'Start', 'filter'=>false, 'value'=>'date("d-m-Y", strtotime($data->Start))'),
        array('name' => 'Finish', 'filter'=>false, 'value'=>'date("d-m-Y", strtotime($data->Finish))'),
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
)); 

?>
