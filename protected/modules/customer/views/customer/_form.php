<?php
/* @var $this CustomerController */
/* @var $model Customer */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'UserID',array('value'=>Yii::app()->user->ID)); ?>
	</div>
	
	<div class="row" style="width:45%;float:left;">
		<?php echo $form->labelEx($model,'FullName'); ?>
		<?php echo $form->textField($model,'FullName',array('maxlength'=>200, 'style'=>'width:100%;')); ?>
		<?php echo $form->error($model,'FullName'); ?>
	</div>

	<div class="row" style="width:45%;float:left;margin-left:8%;">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('maxlength'=>150, 'style'=>'width:100%;')); ?>
		<?php echo $form->error($model,'Email'); ?>
	</div>
	
	<div style="clear:both"></div>

	<div class="row" style="width:45%;float:left;">
		<?php echo $form->labelEx($model,'DNI'); ?>
		<?php echo $form->textField($model,'DNI',array('maxlength'=>10, 'style'=>'width:50%;')); ?>
		<?php echo $form->error($model,'DNI'); ?>
	</div>

	<div class="row" style="width:45%;float:left;margin-left:8%;">
		<?php echo $form->labelEx($model,'Phone'); ?>
		<?php echo $form->textField($model,'Phone',array('maxlength'=>20, 'style'=>'width:50%;')); ?>
		<?php echo $form->error($model,'Phone'); ?>
	</div>
	
	<div style="clear:both"></div>

	<div class="row" style="width:45%;float:left;">
		<?php echo $form->labelEx($model,'BirthDate'); ?>
		<?php echo $form->textField($model,'BirthDate',array('maxlength'=>20, 'style'=>'width:50%;')); ?>
		<?php echo $form->error($model,'BirthDate'); ?>
	</div>
	
	<div class="row" style="width:45%;float:left;margin-left:8%;">
		<?php echo $form->labelEx($model,'Address'); ?>
		<?php echo $form->textField($model,'Address',array('maxlength'=>250, 'style'=>'width:100%;')); ?>
		<?php echo $form->error($model,'Address'); ?>
	</div>
	
	<div style="clear:both"></div>

	<div class="row" style="width:45%;">
		<?php echo $form->labelEx($model,'Comments'); ?>
		<?php echo $form->textArea($model,'Comments',array('style'=>'width:100%;height:70px;')); ?>
		<?php echo $form->error($model,'Comments'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->