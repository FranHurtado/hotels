<?php
/* @var $this WorkerController */
/* @var $model Worker */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'worker-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->hiddenField($model,'UserID', array('value'=>Yii::app()->user->ID)); ?>
	
	<div class="row" style="width:70%;float:left;">
		<?php echo $form->labelEx($model,'Fullname'); ?>
		<?php echo $form->textField($model,'Fullname',array('style'=>'width: 100%;','maxlength'=>150)); ?>
		<?php echo $form->error($model,'Fullname'); ?>
	</div>

	<div class="row" style="width:20%;margin-left:8%;float:left;">
		<?php echo $form->labelEx($model,'DNI'); ?>
		<?php echo $form->textField($model,'DNI',array('style'=>'width: 100%;','maxlength'=>10)); ?>
		<?php echo $form->error($model,'DNI'); ?>
	</div>
	
	<div style="clear:both;"></div>

	<div class="row" style="float:left;">
		<?php echo $form->labelEx($model,'Birthdate'); ?>
		<?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'model'=>$model,
              'attribute'=>'Birthdate',
              'value'=>$model->Birthdate,
              // additional javascript options for the date picker plugin
              'options'=>array(
                'changeYear'=>true,
                'yearRange'=>'1930',
                'language'=>'es',
                'dateFormat'=>'yy-mm-dd',
                'monthNames' => array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"),
                'monthNamesShort' => array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),
                'dayNames' => array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"),
                'dayNamesMin' => array('Do','Lu','Ma','Mi','Ju','Vi','Sa'),
                'defaultDate'=>$model->Birthdate,
              ),
              'htmlOptions'=>array(
                'placeholder'=>'yyyy-mm-dd',
              ),
            ));
        ?>
		<?php echo $form->error($model,'Birthdate'); ?>
	</div>

	<div class="row" style="margin-left:50px;float:left;">
		<?php echo $form->labelEx($model,'Gender'); ?>
		<?php echo $form->dropDownList($model,'Gender',array(0=>'Hombre',1=>'Mujer')); ?>
		<?php echo $form->error($model,'Gender'); ?>
	</div>
	
	<div style="clear:both;"></div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->