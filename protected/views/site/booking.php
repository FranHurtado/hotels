<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<div class="form logo">
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/<?php echo $_GET["id"]; ?>.jpg" align="middle" />
</div>

<div class="form loginform">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	
)); ?>

	<input type="hidden" name="returnURL" value="<?php echo Yii::app()->user->returnURL ?>" />
	
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons" style="margin-top: 15px;">
		<?php echo CHtml::submitButton('Aceptar'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->


<div class="form logo">
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.jpg" align="middle" style="margin-left: 30px;" />
</div>

<div class="form logos">
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logos.jpg" />
</div>