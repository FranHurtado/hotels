<?php
/* @var $this WorkerController */
/* @var $model Worker */

$this->menu=array(
	array('label'=>'Ver Trabajadores', 'url'=>array('admin')),
	array('label'=>'Listado Puntos Criticos', 'url'=>array('point/admin')),
);

?>

<h1 class="header">Modificar al operario:</h1><br />

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>