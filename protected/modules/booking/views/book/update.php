<?php
/* @var $this BookController */
/* @var $model Book */

$this->breadcrumbs=array(
	'Reservas'=>array('admin'),
	'Modificar',
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

<h1 class="header">Modificar reserva</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'modelCustomer'=>$modelCustomer,)); ?>