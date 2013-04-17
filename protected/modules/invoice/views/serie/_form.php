<?php
/* @var $this SerieController */
/* @var $model Serie */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'serie-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row" style="width: 20%; float: left;">
		<?php echo $form->labelEx($model,'Serie'); ?>
		<?php echo $form->textField($model,'Serie',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'Serie'); ?>
	</div>
	
	<div class="row" style="width: 20%; float: left;">
		<?php echo $form->labelEx($model,'Pred'); ?>
		<div class="compactRadioGroup">
		<?php echo $form->radioButtonList($model, 'Pred',
                    array(  0 => 'No',
                            1 => 'Si')); ?>
		</div>
	</div>
	
	<div style="clear: both;"></div>

	<div class="row">
		<?php echo $form->hiddenField($model,'UserID',array('value'=>Yii::app()->user->ID)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->