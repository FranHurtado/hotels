<?php
/* @var $this PointController */
/* @var $model Point */

$this->menu=array(
	array('label'=>'Ver Puntos Criticos', 'url'=>array('admin')),
);

$this->help="- Modifica los campos del formulario que necesites y pulsa guardar.";

?>

<h1>Modificar el punto cr&iacute;tico:</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<a href="<?php echo Yii::app()->createURL("APPC"); ?>" class="backButtonA">Men&uacute;</a>