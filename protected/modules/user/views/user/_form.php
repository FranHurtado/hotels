<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'DNI'); ?>
		<?php echo $form->textField($model,'DNI',array('style'=>'width: 10%;','maxlength'=>11)); ?>
		<?php echo $form->error($model,'DNI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('style'=>'width: 30%;','maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('style'=>'width: 30%;','maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('style'=>'width: 30%;','maxlength'=>100)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('style'=>'width: 30%;','maxlength'=>50)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('style'=>'width: 30%;','maxlength'=>100)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zipcode'); ?>
		<?php echo $form->textField($model,'zipcode',array('style'=>'width: 10%;','maxlength'=>8)); ?>
		<?php echo $form->error($model,'zipcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('style'=>'width: 30%;','maxlength'=>100)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('style'=>'width: 10%;','maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'role',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'camaras'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'freidoras'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'cebos'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'trampas'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->