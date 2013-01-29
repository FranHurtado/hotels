<?php
/* @var $this ControlController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Controls',
);

$this->menu=array(
	array('label'=>'Create Control', 'url'=>array('create')),
	array('label'=>'Manage Control', 'url'=>array('admin')),
);
?>

<h1>Controls</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
