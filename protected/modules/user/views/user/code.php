<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listado de Usuarios', 'url'=>array('admin')),
);
?>

<h1 class="header">Codigo para web</h1><br />

<p>Copia este c&oacute;digo en tu web para obtener un bot&oacute;n que muestre la disponibilidad de tu casa en la web.</p>

<p>Ejemplo: <a href="http://www.turalbacrm.com/index.php/booking/book/planningpublic/id/<?php echo Yii::app()->user->ID; ?>" style="font:9pt Arial;color:white;padding:5px 10px;background:orange;text-decoration:none;border: 2px solid #DB8F2D;background:#EBB052;" target="_blank">Ver Disponibilidad</a></p>

<textarea style="width: 80%;height:100px;padding: 10px;">
<?php
echo htmlspecialchars('<a href="http://www.turalbacrm.com/index.php/booking/book/planningpublic/id/'.Yii::app()->user->ID.'" style="font:9pt Arial;color:white;padding:5px 10px;background:orange;text-decoration:none;border: 2px solid #DB8F2D;background:#EBB052;" target="_blank">Ver Disponibilidad</a>');
?>
</textarea>