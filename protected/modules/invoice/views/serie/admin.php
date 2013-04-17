<?php
/* @var $this SerieController */
/* @var $model Serie */

$this->breadcrumbs=array(
	'Series'=>array('admin'),
	'Listado',
);

$this->menu=array(
	array('label'=>'Nueva Serie', 'url'=>array('create')),
	array('label'=>'Nueva Factura', 'url'=>array('invoice/create')),
	array('label'=>'Listado de facturas', 'url'=>array('invoice/admin')),
);

?>

<h1 class="header">Listado de series</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'serie-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=> 'Serie',
            'filter'=> CHtml::activeTextField($model, 'Serie', 
                 			array('placeholder'=>'Escribe el valor a buscar...')),
        ),
        array(
            'name'=> 'Pred',
            'filter'=> false,
            'value'=> '$data->Pred == 0 ? "No" : "Si";',
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
	'emptyText' => 'No hay registros. <a href="'.$this->createURL('create').'">Picha</a> para crear uno.',
    'summaryText' => 'Mostrando del {start} al {end} de {count} registro(s).',
)); ?>
