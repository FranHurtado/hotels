<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->breadcrumbs=array(
	'Clientes'=>array('admin'),
	'Listado',
);

$this->menu=array(
	array('label'=>'Crear cliente', 'url'=>array('create')),
	array('label'=>'Crear boletin', 'url'=>array('/mail/mail/create')),
	array('label'=>'Listado clientes PDF', 'url'=>array('print')),
);

$this->help='Pulsa Crear Cliente para a&ntilde;adir un cliente al listado.<br /><br />Tambi&eacute;n podr&aacute;s enviar un 
				bolet&iacute;n o exportar un listado de los clientes en PDF.';
?>

<h1 class="header">Listado de clientes</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=> 'DNI',
            'filter'=> false,
            'headerHtmlOptions'=>array(
                'style'=>'width:10%;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:10%;text-align:left;',
            ),
        ),
		array(
            'name'=> 'FullName',
            'filter'=> CHtml::activeTextField($model, 'FullName', 
                 			array('placeholder'=>'Escribe el valor a buscar...')),
            'headerHtmlOptions'=>array(
                'style'=>'width:40%;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:40%;text-align:left;',
            ),
        ),
		array(
            'name'=> 'Phone',
            'filter'=> false,
            'headerHtmlOptions'=>array(
                'style'=>'width:10%;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:10%;text-align:left;',
            ),
        ),
		array(
            'name'=> 'Email',
            'filter'=> false,
            'headerHtmlOptions'=>array(
                'style'=>'text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'text-align:left;',
            ),
        ),
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
	'emptyText' => 'No hay registros. <a href="'.$this->createURL('create').'">Pincha</a> para crear uno.',
    'summaryText' => 'Mostrando del {start} al {end} de {count} registro(s).',
)); ?>
