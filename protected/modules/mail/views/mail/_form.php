<?php
/* @var $this MailController */
/* @var $model Mail */
/* @var $form CActiveForm */
?>

<?php
	$criteria = new CDbCriteria();
	$criteria->condition = "UserID = :userid";
	$criteria->params = array(':userid' => Yii::app()->user->ID);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mail-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'UserID'); ?>
		<?php echo CHtml::hiddenField('Enviar','0'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ListID'); ?>
		<?php echo $form->dropDownList($model,'ListID', CHtml::listData(Mailist::model()->findAll($criteria), 'ID', 'Name'), 
											array('empty'=>'-- Selecciona una lista de envio --', 'style' => 'width: 50%;')); ?>
		<?php echo $form->error($model,'ListID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('style' => 'width: 98%;','maxlength'=>100,'placeholder'=>'Este sera el asunto del mensaje')); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'Date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Text'); ?>
		<?php 
	        $this->widget('ext.editMe.widgets.ExtEditMe', array(
			    'model'=>$model,
			    'attribute'=>'Text',
			    'filebrowserImageBrowseUrl'=> Yii::app()->baseUrl . '/kcfinder/browse.php?type=images',
			    'filebrowserImageUploadUrl'=> Yii::app()->baseUrl . '/kcfinder/upload.php?type=images',
			    'toolbar'=>array(
						        array('Source', 'Preview',),
						        array('Cut','Copy','Paste','PasteText','PasteFromWord','Undo','Redo',),
						        array('Image','Table','Link',),
						        array('Font','FontSize','TextColor','BGColor','Bold','Italic','Underline','NumberedList','BulletedList','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock',),
						),
				'height'=>400,
			));
        ?>
		<?php echo $form->error($model,'Text'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>&nbsp;
		
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar y enviar' : 'Guardar y enviar', array('id'=>'submitForm')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	$("#submitForm").click(function(){
		$("#Enviar").val("1");
	});
</script>