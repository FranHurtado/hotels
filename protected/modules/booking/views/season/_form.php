<?php
/* @var $this SeasonController */
/* @var $model Season */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'season-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'UserID',array('value'=>Yii::app()->user->ID)); ?>
	</div>

	<div class="row" style="float: left; width: 50%;">		
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('style'=>'width:100%;','maxlength'=>100)); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>
	
	<div class="row" style="float: left; width: 30%; margin-left: 5%;">
		<?php echo $form->labelEx($model,'Type'); ?>
		<?php echo $form->dropDownList($model,'Type',
											array(0=>'Baja',1=>'Media',2=>'Alta'),
											array('empty'=>'-- Selecciona el tipo de temporada --', 'style'=>'width:100%;')); ?>
		<?php echo $form->error($model,'Type'); ?>
	</div>
	
	<div style="clear:both;"></div>

	<div class="row" style="float: left; width: 15%;">
		<?php echo $form->labelEx($model,'Start'); ?>
		<?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'model'=>$model,
              'attribute'=>'Start',
              'value'=>$model->Start,
              // additional javascript options for the date picker plugin
              'options'=>array(
                'changeYear'=>true,
                'yearRange'=>'2000:2050',
                'language'=>'es',
                'dateFormat'=>'yy-mm-dd',
                'monthNames' => array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"),
                'monthNamesShort' => array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),
                'dayNames' => array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"),
                'dayNamesMin' => array('Do','Lu','Ma','Mi','Ju','Vi','Sa'),
                'defaultDate'=>$model->Start,
                'firstDay'=>1,
              ),
              'htmlOptions'=>array(
                'placeholder'=>'yyyy-mm-dd',
                'style'=>'width:100%;',
              ),
            ));
        ?>
		<?php echo $form->error($model,'Start'); ?>
	</div>

	<div class="row" style="float: left; width: 15%; margin-left: 5%;">
		<?php echo $form->labelEx($model,'Finish'); ?>
		<?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'model'=>$model,
              'attribute'=>'Finish',
              'value'=>$model->Finish,
              // additional javascript options for the date picker plugin
              'options'=>array(
                'changeYear'=>true,
                'yearRange'=>'2000:2050',
                'language'=>'es',
                'dateFormat'=>'yy-mm-dd',
                'monthNames' => array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"),
                'monthNamesShort' => array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),
                'dayNames' => array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"),
                'dayNamesMin' => array('Do','Lu','Ma','Mi','Ju','Vi','Sa'),
                'defaultDate'=>$model->Finish,
                'firstDay'=>1,
              ),
              'htmlOptions'=>array(
                'placeholder'=>'yyyy-mm-dd',
                'style'=>'width:100%;',
              ),
            ));
        ?>
		<?php echo $form->error($model,'Finish'); ?>
	</div>
	
	<div style="clear:both;"></div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->