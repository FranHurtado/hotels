<?php
/* @var $this RoomController */
/* @var $model Room */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'room-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'UserID',array('value'=>Yii::app()->user->ID)); ?>
	</div>

	<div class="row" style="float: left; width: 44%;">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('style'=>'width:100%;','maxlength'=>150)); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row" style="float: left; width: 12%; margin-left: 5%;">
		<?php echo $form->labelEx($model,'PriceBig'); ?>
		<?php echo $form->textField($model,'PriceBig',array('style'=>'width:100%;','maxlength'=>10)); ?>
		<?php echo $form->error($model,'PriceBig'); ?>
	</div>
	
	<div class="row" style="float: left; width: 12%; margin-left: 5%;">
		<?php echo $form->labelEx($model,'PriceMed'); ?>
		<?php echo $form->textField($model,'PriceMed',array('style'=>'width:100%;','maxlength'=>10)); ?>
		<?php echo $form->error($model,'PriceMed'); ?>
	</div>

	<div class="row" style="float: left; width: 12%; margin-left: 5%;">
		<?php echo $form->labelEx($model,'PriceLow'); ?>
		<?php echo $form->textField($model,'PriceLow',array('style'=>'width:100%;','maxlength'=>10)); ?>
		<?php echo $form->error($model,'PriceLow'); ?>
	</div>
	
	<div style="clear:both;"></div>
	
	<div class="row" style="width: 20%; float: left;">
		<?php echo $form->labelEx($model,'Type'); ?>
		<div class="compactRadioGroup">
		<?php echo $form->radioButtonList($model, 'Type',
                    array(  0 => 'Precio por noche',
                            1 => 'Precio por persona')); ?>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->