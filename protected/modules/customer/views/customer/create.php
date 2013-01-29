<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->breadcrumbs=array(
	'Clientes'=>array('admin'),
	'Nuevo cliente',
);

$this->menu=array(
	array('label'=>'Listado de clientes', 'url'=>array('admin')),
	array('label'=>'Listado de clientes en PDF', 'url'=>array('admin')),
	array('label'=>'Enviar boletin a mis clientes', 'url'=>array('admin')),
);
?>

<h1 class="header">Nuevo cliente</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>