<?php
/* @var $this BookController */
/* @var $model Book */

$this->breadcrumbs=array(
	'Reservas'=>array('admin'),
	'Listado',
);

$this->menu=array(
	array('label'=>'Nueva Reserva', 'url'=>array('create')),
	array('label'=>'Listado Reservas', 'url'=>array('admin')),
	array('label'=>'Nueva Habitacion', 'url'=>array('/booking/room/create')),
	array('label'=>'Listado Habitaciones', 'url'=>array('/booking/room/admin')),
	array('label'=>'Nueva Temporada', 'url'=>array('/booking/season/create')),
	array('label'=>'Listado Temporadas', 'url'=>array('/booking/season/admin')),
);

?>

<h1 class="header">Planning de reservas</h1>

<?php 

$criteriaRooms = new CDbCriteria();
$criteriaRooms->condition = 'UserID = :userid';
$criteriaRooms->params = array(':userid' => Yii::app()->user->ID);
$criteriaRooms->order = 'Name Desc';

$criteriaBooks = new CDbCriteria();
$criteriaBooks->condition = 'UserID = :userid';
$criteriaBooks->params = array(':userid' => Yii::app()->user->ID);
$criteriaBooks->order = 'ID';

$this->widget('ext.planning.EPlanning', array(
    'model' => Room::model()->findAll($criteriaRooms),
    'books' => Book::model()->findAll($criteriaBooks),
)); 

?>

<div style="width:40%;padding-left: 20%;margin-top: 5%;">

<table cellpadding="0" cellspacing="2">
	<tr>
		<td width="10%" style="border: 1px solid #333;">&nbsp;</td><td>Libre</td><td>&nbsp;</td>
		<td width="10%" style="border: 1px solid #333;background: red;">&nbsp;</td><td>Reservado</td><td>&nbsp;</td>
		<td width="10%" style="border: 1px solid #333;background: #888;">&nbsp;</td><td>Cobrada</td><td>&nbsp;</td>
	</tr>
</table>

</div>