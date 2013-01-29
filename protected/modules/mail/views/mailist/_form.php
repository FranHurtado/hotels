<?php
/* @var $this MailistController */
/* @var $model Mailist */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mailist-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'UserID'); ?>
	</div>

	<div style="width:40%;float:left;">
		<div class="row">
			<?php echo $form->labelEx($model,'Name'); ?>
			<?php echo $form->textField($model,'Name',array('style'=>'width:100%;','maxlength'=>100)); ?>
			<?php echo $form->error($model,'Name'); ?>
		</div>
	
		<div class="row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
		</div>
	</div>
	
	<?php if($model->isNewRecord == false) : ?>
		<div style="width:45%;float:right;">
		
			<h2>Lista de clientes introducidos:</h2>
		
			<?php echo CHTML::dropDownList('newEmail','', CHtml::listData(Customer::model()->findAll(), 'ID', 'Email'), 
								array('empty'=>'-- Selecciona un cliente para a&ntilde;adirlo a la lista --', 'style' => 'width: 100%;')); ?>
								
			<div id="mailist" style="padding: 5px 0;">
				<?php echo $this->renderPartial('_emailist', array('model'=>$model)); ?>
			</div>
				
		</div>
		
	<?php endif; ?>
	
	
	<div style="clear:both;"></div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	<?php if($model->isNewRecord == false) : ?>
	
		$(document).ready(function(){
				
				$("#newEmail").bind("change", function(){
					$("#mailist").css({"opacity" : 0.2});
					
					var request = $.ajax({
		                url: "<?php echo $this->createURL("mailist/addcustomer"); ?>",
		                type: "POST",
		                data: {
		                    newEmail : $(this).val(), 
		                    listID : <?php echo $model->ID; ?>, 
		                },
		                dataType: "html"
		            });
		
		            request.done(function(msg) {
		        		$("#mailist").html(msg);
		                $("#mailist").css({"opacity" : 1});
		                $(".jqueryOk").delay(2500).slideToggle();
		                $(".jqueryError").delay(2500).slideToggle();
		            });
				});		
		});
		
	<?php endif; ?>
</script>
