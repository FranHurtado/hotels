<?php
/* @var $this MailistController */
/* @var $model Mailist */

$this->breadcrumbs=array(
	'Mailists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Ver Boletines', 'url'=>array('mail/admin')),
	array('label'=>'Ver Listas de Envio', 'url'=>array('admin')),
	array('label'=>'Crear Boletin', 'url'=>array('mail/create')),
);
?>

<h1 class="header">Crear lista de env&iacute;o</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>