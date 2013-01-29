<?php
/* @var $this PointController */
/* @var $model Point */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'point-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->hiddenField($model,'UserID', array('value'=>Yii::app()->user->ID)); ?>
		
	<div class="row">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('style'=>'width: 98%;','maxlength'=>150)); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Description'); ?>
		<?php echo $form->textArea($model,'Description',array('style'=>'width: 98%;height:70px;')); ?>
		<?php echo $form->error($model,'Description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Goal'); ?>
		<?php echo $form->textArea($model,'Goal',array('style'=>'width: 98%;height:70px;')); ?>
		<?php echo $form->error($model,'Goal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Actions'); ?>
		<?php echo $form->textArea($model,'Actions',array('style'=>'width: 98%;height:70px;')); ?>
		<?php echo $form->error($model,'Actions'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->