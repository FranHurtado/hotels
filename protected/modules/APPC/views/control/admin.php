<?php
/* @var $this ControlController */
/* @var $model Control */

$this->breadcrumbs=array(
	'Controls'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Nuevo Control', 'url'=>array('create')),
	array('label'=>'Listado Puntos Criticos', 'url'=>array('point/admin')),
);

?>

<h1 class="header">Listado de controles</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'control-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'Name',
            'headerHtmlOptions'=>array(
                'style'=>'text-align:left !important;',
            ),
        ),
		array(
            'name'=>'PointID',
            'value'=>'$data->point->Name',
            'headerHtmlOptions'=>array(
                'style'=>'text-align:left !important;',
            ),
        ),
		array(
            'name'=>'Frecuency',
            'value'=>'Control::model()->giveFrecuency($data->Frecuency)',
            'headerHtmlOptions'=>array(
                'style'=>'width:100px;text-align:left !important;',
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
	'emptyText' => 'No hay registros.',
    'summaryText' => 'Mostrando del {start} al {end} de {count} registro(s).',
)); ?>

<?php
	$dp = $model->search();
	if($dp->totalItemCount == 0){ ?> <script>$(".filters").hide();</script> <?php }
?>