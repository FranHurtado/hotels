<?php
/* @var $this ControlController */
/* @var $model Control */

$this->menu=array(
	array('label'=>'Ver Controles', 'url'=>array('admin')),
	array('label'=>'Listado Puntos Criticos', 'url'=>array('point/admin')),
);

?>

<h1>Crear nuevo control</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>