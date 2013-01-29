<?php
/* @var $this PointController */
/* @var $model Point */

$this->breadcrumbs=array(
	'Puntos cr&iacute;ticos'=>array('admin'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listado Puntos Criticos', 'url'=>array('admin')),
	array('label'=>'Crear Control', 'url'=>array('control/create')),
	array('label'=>'Crear Trabajador', 'url'=>array('worker/create')),
);


?>

<h1>Crear nuevo punto cr&iacute;tico</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>