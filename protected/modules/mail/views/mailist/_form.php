<?php
/* @var $this MailistController */
/* @var $model Mailist */
/* @var $form CActiveForm */
?>

<?php
	$criteria = new CDbCriteria();
	$criteria->condition = "UserID = :userid";
	$criteria->params = array(':userid' => Yii::app()->user->ID);
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
				
			$(".customerEmail").bind("change", function(){
				if($(this).is(':checked')) {
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
		            });
		        }else{
			        var request = $.ajax({
			            url: "<?php echo $this->createURL("mailist/deletecustomer"); ?>",
			            type: "POST",
			            data: {
			                newEmail : $(this).val(),
			                listID : <?php echo $model->ID; ?>, 
			            },
			            dataType: "html"
			        });
			
			        request.done(function(msg) {
			        });
		        }
			});
			
			$(".customerEmailAll").bind("change", function(){
				if($(this).is(':checked')) {
					$(".customerEmail").each(function(){
						$(this).attr('checked', true);
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
			            });
					});
		        }else{
			        $(".customerEmail").each(function(){
						$(this).attr('checked', false);
						var request = $.ajax({
				            url: "<?php echo $this->createURL("mailist/deletecustomer"); ?>",
				            type: "POST",
				            data: {
				                newEmail : $(this).val(),
				                listID : <?php echo $model->ID; ?>, 
				            },
				            dataType: "html"
				        });
				
				        request.done(function(msg) {
				        });
					});
		        }
			});
						
		});
		
	<?php endif; ?>
</script>
