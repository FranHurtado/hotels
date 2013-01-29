<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->breadcrumbs=array(
	'Clientes'=>array('admin'),
	'Listado',
);

$this->menu=array(
	array('label'=>'Crear nuevo cliente', 'url'=>array('create')),
	array('label'=>'Listado de clientes en PDF', 'url'=>array('admin')),
	array('label'=>'Enviar boletin a mis clientes', 'url'=>array('admin')),
);
?>

<h1 class="header">Listado de clientes</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=> 'DNI',
            'headerHtmlOptions'=>array(
                'style'=>'width:100px;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:100px;text-align:left;',
            ),
        ),
		array(
            'name'=> 'FullName',
            'headerHtmlOptions'=>array(
                'style'=>'width:150px;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:150px;text-align:left;',
            ),
        ),
		array(
            'name'=> 'Phone',
            'headerHtmlOptions'=>array(
                'style'=>'width:50px;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:50px;text-align:left;',
            ),
        ),
		'Email',
		array(	
	        'class'=>'CButtonColumn',
	        'template'=>'{update} {delete}',
	        'buttons' => array(
	            'update' => array(
	            	'label' => 'Editar',
	            	'imageUrl' => Yii::app()->baseURL . '/images/edit.png',
	            ),
	            'delete' => array(
	            	'label' => 'Borrar',
	                'imageUrl' => Yii::app()->baseURL . '/images/delete.png',
	            ),
	        ),
	        'deleteConfirmation'=>'Si aceptas eliminaras este registro definitivamente.',
	     ),
	),
	'emptyText' => 'No hay registros.',
    'summaryText' => 'Mostrando del {start} al {end} de {count} registro(s).',
)); ?>
