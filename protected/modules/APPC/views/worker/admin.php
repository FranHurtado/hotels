<?php
/* @var $this WorkerController */
/* @var $model Worker */


$this->menu=array(
	array('label'=>'Crear Trabajador', 'url'=>array('create')),
	array('label'=>'Listado Puntos Criticos', 'url'=>array('point/admin')),
); 

?>

<h1 class="header">Listado de operarios</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'worker-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'Fullname',
            'headerHtmlOptions'=>array(
                'style'=>'text-align:left !important;',
            ),
        ),
        array(
            'name'=>'DNI',
            'headerHtmlOptions'=>array(
                'style'=>'width: 120px;text-align:center !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width: 120px;text-align:center !important;',
            ),
        ),
        array(
            'name'=>'Birthdate',
            'headerHtmlOptions'=>array(
                'style'=>'width: 120px;text-align:center !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width: 120px;text-align:center !important;',
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