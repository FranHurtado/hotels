<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listado de Usuarios', 'url'=>array('admin')),
);
?>

<h1 class="header">Modificar Usuario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>