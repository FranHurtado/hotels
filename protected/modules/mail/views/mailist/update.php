<?php
/* @var $this MailistController */
/* @var $model Mailist */

$this->breadcrumbs=array(
	'Mailists'=>array('index'),
	$model->Name=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'Ver Boletines', 'url'=>array('mail/admin')),
	array('label'=>'Ver Listas de Envio', 'url'=>array('admin')),
	array('label'=>'Crear Boletin', 'url'=>array('mail/create')),
);
?>

<h1 class="header">Modificar lista de env&iacute;o</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>