<?php
/* @var $this SeasonController */
/* @var $model Season */

$this->breadcrumbs=array(
	'Temporadas'=>array('admin'),
	'Editar temporada',
);

$this->menu=array(
	array('label'=>'Planning de reservas', 'url'=>array('/booking/book/planning')),
	array('label'=>'Nueva Reserva', 'url'=>array('/booking/book/create')),
	array('label'=>'Listado Reservas', 'url'=>array('/booking/book/admin')),
	array('label'=>'Nueva Habitacion', 'url'=>array('/booking/room/create')),
	array('label'=>'Listado Habitaciones', 'url'=>array('/booking/room/admin')),
	array('label'=>'Nueva Temporada', 'url'=>array('/booking/season/create')),
	array('label'=>'Listado Temporadas', 'url'=>array('/booking/season/admin')),
);
?>

<h1 class="header">Modificar temporada</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>