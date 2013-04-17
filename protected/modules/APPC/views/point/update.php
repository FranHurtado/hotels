<?php
/* @var $this PointController */
/* @var $model Point */

$this->menu=array(
	array('label'=>'Ver Puntos Criticos', 'url'=>array('admin')),
);

?>

<h1>Modificar el punto cr&iacute;tico:</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>