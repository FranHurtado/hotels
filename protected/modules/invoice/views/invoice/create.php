<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->breadcrumbs=array(
	'Facturas'=>array('admin'),
	'Nueva factura',
);

$this->menu=array(
	array('label'=>'Listado de facturas', 'url'=>array('admin')),
	array('label'=>'Nueva Serie', 'url'=>array('serie/create')),
	array('label'=>'Listado de series', 'url'=>array('serie/admin')),
);
?>

<h1 class="header">Crear nueva factura</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'modelCustomer'=>$modelCustomer,)); ?>