<?php
/* @var $this ControlController */
/* @var $model Control */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'control-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->hiddenField($model,'UserID',array('value'=>Yii::app()->user->ID)); ?>

	<div class="row" style="float: left;width:31%;">
		<?php echo $form->labelEx($model,'WorkerID'); ?>
		<?php echo $form->dropDownList($model,'WorkerID', CHtml::listData(Worker::model()->findAll(), 'ID', 'Fullname'), 
											array('empty'=>'-- Selecciona un operario --', 'style' => 'width: 100%;')); ?>
		<?php echo $form->error($model,'WorkerID'); ?>
	</div>

	<div class="row" style="float: left;width:60%;margin-left: 8%;">
		<?php echo $form->labelEx($model,'PointID'); ?>
		<?php echo $form->dropDownList($model,'PointID', CHtml::listData(Point::model()->findAll(), 'ID', 'Name'), 
											array('empty'=>'-- Selecciona el punto critico --', 'style' => 'width: 100%;')); ?>
		<?php echo $form->error($model,'PointID'); ?>
	</div>
	
	<div class="clear"></div>

	<div class="row">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('style'=>'width: 98%;','maxlength'=>150)); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Task'); ?>
		<?php echo $form->textArea($model,'Task',array('style'=>'width: 98%;height:70px;')); ?>
		<?php echo $form->error($model,'Task'); ?>
	</div>

	<div class="row" style="float: left;width:25%;">
		<?php echo $form->labelEx($model,'Startdate'); ?>
		<?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'model'=>$model,
              'attribute'=>'Startdate',
              'value'=>$model->Startdate,
              // additional javascript options for the date picker plugin
              'options'=>array(
                'changeYear'=>true,
                'yearRange'=>'1990',
                'language'=>'es',
                'dateFormat'=>'yy-mm-dd',
                'monthNames' => array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"),
                'monthNamesShort' => array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),
                'dayNames' => array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"),
                'dayNamesMin' => array('Do','Lu','Ma','Mi','Ju','Vi','Sa'),
                'defaultDate'=>$model->Startdate,
              ),
              'htmlOptions'=>array(
                'placeholder'=>'yyyy-mm-dd',
                'style'=>'width:100%;',
              ),
            ));
        ?>
		<?php echo $form->error($model,'Startdate'); ?>
	</div>

	<div class="row" style="float: left;width:25%;margin-left: 8%;">
		<?php echo $form->labelEx($model,'Enddate'); ?>
		<?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'model'=>$model,
              'attribute'=>'Enddate',
              'value'=>$model->Enddate,
              // additional javascript options for the date picker plugin
              'options'=>array(
                'changeYear'=>true,
                'yearRange'=>'1990',
                'language'=>'es',
                'dateFormat'=>'yy-mm-dd',
                'monthNames' => array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"),
                'monthNamesShort' => array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),
                'dayNames' => array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"),
                'dayNamesMin' => array('Do','Lu','Ma','Mi','Ju','Vi','Sa'),
                'defaultDate'=>$model->Enddate,
              ),
              'htmlOptions'=>array(
                'placeholder'=>'yyyy-mm-dd',
                'style'=>'width:100%;',
              ),
            ));
        ?>
		<?php echo $form->error($model,'Enddate'); ?>
	</div>

	<div class="row" style="float: left;width:25%;margin-left: 8%;">
		<?php echo $form->labelEx($model,'Frecuency'); ?>
		<?php echo $form->dropDownList($model,'Frecuency',
											array(0=>'Diaria',1=>'Semanal',2=>'Mensual',3=>'Anual'),
											array('empty'=>'-- Selecciona la frecuencia --', 'style'=>'width:100%;')); ?>
		<?php echo $form->error($model,'Frecuency'); ?>
	</div>
	
	<div class="clear"></div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->