<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->breadcrumbs=array(
	'Facturas'=>array('admin'),
	'Listado',
);

$this->menu=array(
	array('label'=>'Nueva Factura', 'url'=>array('create')),
	array('label'=>'Nueva Serie', 'url'=>array('serie/create')),
	array('label'=>'Listado de series', 'url'=>array('serie/admin')),
);

?>

<h1 class="header">Listado de facturas</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'invoice-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate'=>"function(){
							jQuery('#date_Date').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'dateFormat':'yy-mm-dd'}));
						}",
	'columns'=>array(
		array(
            'name'=> 'SerieID',
            'value' => '$data->serie->Serie',
	        'filter' => CHtml::listData(Serie::model()->findAll(), 'ID', 'Serie'),
            'headerHtmlOptions'=>array(
                'style'=>'width:10%;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:10%;text-align:left;',
            ),
        ),
		array(
            'name'=> 'Number',
            'filter'=> CHtml::activeTextField($model, 'Number', 
                 			array('placeholder'=>'Escribe el valor a buscar...')),
            'headerHtmlOptions'=>array(
                'style'=>'width:15%;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:15%;text-align:left;',
            ),
        ),
		array(
            'name'=> 'CustomerID',
            'value' => '$data->customer->FullName',
	        'filter' => CHtml::listData(Customer::model()->findAll(), 'ID', 'FullName'),
            'headerHtmlOptions'=>array(
                'style'=>'width:50%;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:50%;text-align:left;',
            ),
        ),
        array('name' => 'Date', 'filter'=>false, 'value'=>'date("d-m-Y", strtotime($data->Date))'),
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
	'emptyText' => 'No hay registros. <a href="'.$this->createURL('create').'">Picha</a> para crear uno.',
    'summaryText' => 'Mostrando del {start} al {end} de {count} registro(s).',
)); 
