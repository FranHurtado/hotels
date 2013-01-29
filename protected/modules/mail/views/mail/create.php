<?php
/* @var $this MailController */
/* @var $model Mail */

$this->breadcrumbs=array(
	'Mails'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Ver Listas de envio', 'url'=>array('mailist/admin')),
	array('label'=>'Ver Boletines', 'url'=>array('admin')),
);
?>

<h1 class="header">Crear nuevo bolet&iacute;n</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model), false, true); ?>