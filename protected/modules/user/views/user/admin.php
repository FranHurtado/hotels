<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Usuarios'=>array('admin'),
	'Listado',
);

$this->menu=array(
	array('label'=>'Crear Nuevo Usuario', 'url'=>array('create')),
);

?>

<h1>Gesti&oacute;n de usuarios</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'email',
		'username',
		'phone',
		/*
		'zipcode',
		'city',
		'phone',
		'role',
		'active',
		'camaras',
		'freidoras',
		'cebos',
		'trampas',
		*/
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
)); ?>
