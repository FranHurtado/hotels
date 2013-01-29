<?php
/* @var $this MailistController */
/* @var $model Mailist */

$this->breadcrumbs=array(
	'Listas de envio'=>array('admin'),
	'Listado',
);

$this->menu=array(
	array('label'=>'Crear Lista de Envio', 'url'=>array('create')),
	array('label'=>'Ver Boletines', 'url'=>array('mail/admin')),
	array('label'=>'Crear Boletin', 'url'=>array('mail/create')),
);

?>

<h1 class="header">Listas de env&iacute;o</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mailist-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'Name',
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
