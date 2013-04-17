<?php
/* @var $this WorkerController */
/* @var $model Worker */

$this->menu=array(
	array('label'=>'Ver Operarios', 'url'=>array('admin')),
);

$this->help="- Rellena todos los campos del formulario y pulsa guardar.";
?>

<h1>Crear nuevo operario</h1><br />

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>


<a href="<?php echo Yii::app()->createURL("APPC"); ?>" class="backButton">Men&uacute;</a>