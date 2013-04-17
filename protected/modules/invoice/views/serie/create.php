<?php
/* @var $this SerieController */
/* @var $model Serie */

$this->breadcrumbs=array(
	'Series'=>array('admin'),
	'Crear serie',
);

$this->menu=array(
	array('label'=>'Listado de series', 'url'=>array('admin')),
	array('label'=>'Nueva Factura', 'url'=>array('invoice/create')),
	array('label'=>'Listado de facturas', 'url'=>array('invoice/admin')),
);
?>

<h1 class="header">Crear serie</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>