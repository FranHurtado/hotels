<?php
/* @var $this InvoiceController */
/* @var $model Invoice */
/* @var $form CActiveForm */
?>

<?php
	$criteria = new CDbCriteria();
	$criteria->condition = "UserID = :userid";
	$criteria->params = array(':userid' => Yii::app()->user->ID);
	$criteria->order = 'ID desc';
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invoice-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'UserID',array('value'=>Yii::app()->user->ID)); ?>
	</div>
	
	<div class="row" style="width: 20%; float: left;">
		<?php echo $form->labelEx($model,'SerieID'); ?>
		<?php echo $form->dropDownList($model,'SerieID', CHtml::listData(Serie::model()->findAll($criteria), 'ID', 'Serie'), 
											array('style' => 'width: 100%;')); ?>
		<?php echo $form->error($model,'SerieID'); ?>
	</div>
	
	<?php
		// If it is a new record. We calculate the next invoice number
		if($model->isNewRecord) : 
			$criteriaNextNumber = new CDbCriteria();
			$criteriaNextNumber->condition = 'UserID = :userid';
			$criteriaNextNumber->params = array(':userid' => Yii::app()->user->ID);
			$criteriaNextNumber->order = 'Number Desc'; 
			$model->Number = Invoice::model()->find($criteriaNextNumber)->ID + 1;
		endif;
	?>
	
	<div class="row" style="width: 15%; float: left; margin-left: 5%;">
		<?php echo $form->labelEx($model,'Number'); ?>
		<?php echo $form->textField($model,'Number',array('style' => 'width: 100%;','maxlength'=>25)); ?>
		<?php echo $form->error($model,'Number'); ?>
	</div>

	<div class="row" style="width: 15%; float: left; margin-left: 5%;">
		<?php echo $form->labelEx($model,'Date'); ?>
		<?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'model'=>$model,
              'attribute'=>'Date',
              'value'=>$model->Date,
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
                'defaultDate'=>$model->Date,
              ),
              'htmlOptions'=>array(
                'placeholder'=>'yyyy-mm-dd',
                'style'=>'width:100%;',
              ),
            ));
        ?>
		<?php echo $form->error($model,'Date'); ?>
	</div>
	
	<div style="clear:both;"></div>
	
	<div class="row" style="width: 50%;">
		<?php echo $form->labelEx($model,'CustomerID'); ?>
		<?php echo $form->dropDownList($model,'CustomerID', CHtml::listData(Customer::model()->findAll($criteria), 'ID', 'FullName'), 
											array('empty'=>'-- Selecciona un cliente o rellena el formulario mas abajo --', 'style' => 'width: 77%;')); ?>
		<?php echo $form->error($model,'CustomerID'); ?>
	</div><br /><br />
	
	<h1>Datos del cliente</h1>

	<div id="CustomerForm" style="padding: 10px 25px;border: 1px solid #dddddd;">
	
		<div class="row" style="width:45%;float:left;">
			<?php echo $form->labelEx($modelCustomer,'FullName'); ?>
			<?php echo $form->textField($modelCustomer,'FullName',array('maxlength'=>200, 'style'=>'width:100%;')); ?>
			<?php echo $form->error($modelCustomer,'FullName'); ?>
		</div>
	
		<div class="row" style="width:45%;float:left;margin-left:8%;">
			<?php echo $form->labelEx($modelCustomer,'Email'); ?>
			<?php echo $form->textField($modelCustomer,'Email',array('maxlength'=>150, 'style'=>'width:100%;')); ?>
			<?php echo $form->error($modelCustomer,'Email'); ?>
		</div>
		
		<div style="clear:both"></div>
	
		<div class="row" style="width:45%;float:left;">
			<?php echo $form->labelEx($modelCustomer,'DNI'); ?>
			<?php echo $form->textField($modelCustomer,'DNI',array('maxlength'=>10, 'style'=>'width:50%;')); ?>
			<?php echo $form->error($modelCustomer,'DNI'); ?>
		</div>
	
		<div class="row" style="width:45%;float:left;margin-left:8%;">
			<?php echo $form->labelEx($modelCustomer,'Phone'); ?>
			<?php echo $form->textField($modelCustomer,'Phone',array('maxlength'=>20, 'style'=>'width:50%;')); ?>
			<?php echo $form->error($modelCustomer,'Phone'); ?>
		</div>
		
		<div style="clear:both"></div>
	
		<div class="row" style="width:45%;float:left;">
			<?php echo $form->labelEx($modelCustomer,'BirthDate'); ?>
			<?php 
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	              'model'=>$modelCustomer,
	              'attribute'=>'BirthDate',
	              'value'=>$modelCustomer->BirthDate,
	              // additional javascript options for the date picker plugin
	              'options'=>array(
	                'changeYear'=>true,
	                'yearRange'=>'1900:2000',
	                'language'=>'es',
	                'dateFormat'=>'yy-mm-dd',
	                'monthNames' => array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"),
	                'monthNamesShort' => array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),
	                'dayNames' => array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"),
	                'dayNamesMin' => array('Do','Lu','Ma','Mi','Ju','Vi','Sa'),
	                'defaultDate'=>$modelCustomer->BirthDate,
	              ),
	              'htmlOptions'=>array(
	                'placeholder'=>'yyyy-mm-dd',
	                'maxlength'=>'20',
	                'style'=>'width:50%;',
	              ),
	            ));
	        ?>
			<?php echo $form->error($modelCustomer,'BirthDate'); ?>
		</div>
		
		<div class="row" style="width:45%;float:left;margin-left:8%;">
			<?php echo $form->labelEx($modelCustomer,'Address'); ?>
			<?php echo $form->textField($modelCustomer,'Address',array('maxlength'=>250, 'style'=>'width:100%;')); ?>
			<?php echo $form->error($modelCustomer,'Address'); ?>
		</div>
		
		<div style="clear:both"></div>
	
		<div class="row" style="width:45%;">
			<?php echo $form->labelEx($modelCustomer,'Comments'); ?>
			<?php echo $form->textArea($modelCustomer,'Comments',array('style'=>'width:100%;height:70px;')); ?>
			<?php echo $form->error($modelCustomer,'Comments'); ?>
		</div>
		
	</div><br /><br />
	
	<?php if(!$model->isNewRecord): ?>
	
	<h1>Conceptos de la factura</h1>

	<div id="ConceptForm" style="padding: 10px 25px;border: 1px solid #dddddd;">
		<div id="concepts">
		<?php
			$criteria = new CDbCriteria();
			$criteria->condition = "UserID = :userid AND InvoiceID = :invoiceid";
			$criteria->params = array(':userid' => Yii::app()->user->ID, ':invoiceid' => $model->ID);
			
			$modelCharges = Charge::model()->findAll($criteria);
			
			foreach($modelCharges as $charge):
				echo "<p><span class='deleteCharge' id='". $charge->ID ."'>X</span>" . $charge->Text . " | " . str_replace('.',',',$charge->Price) . "&euro;</p>";
			endforeach;
		?>
		</div>
	</div><br /><br />
	
	<h1>A&ntilde;adir concepto</h1>
	
	<div class="row" style="width:50%;float:left;">
		<?php echo CHtml::label('Escriba el concepto','chargeName'); ?>
		<?php echo CHtml::textField('chargeName','',array('maxlength'=>150, 'style'=>'width:100%;')); ?>
	</div>
	<div class="row" style="width:5%;float:left;margin-left:5%;">
		<?php echo CHtml::label('&euro;','chargeValue',array('style'=>'width:100%;text-align:center;padding-left:20%;')); ?>
		<?php echo CHtml::textField('chargeValue','',array('maxlength'=>5, 'style'=>'width:100%;')); ?>
	</div>
	<div class="row" style="width:10%;float:left;margin-left:5%;">
		<?php echo CHtml::button('Contabilizar',array('id'=>'addCharge','style'=>'margin-top: 12px;')); ?>
	</div>
	
	<div style="clear:both"></div>
	
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?> 
		<?php if(!$model->isNewRecord): ?>
			&nbsp;&nbsp;
			<?php echo CHtml::button('Imprimir factura', array('id'=>'btnImprimir')); ?>
		<?php endif; ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	
	$(document).ready(function(){
		$("#Invoice_CustomerID").change(function(){
			if($(this).value != "")
			{
				var request = $.ajax({
	                url: "<?php echo $this->createURL("invoice/fillcustomer"); ?>",
	                type: "POST",
	                data: {
	                    id : $(this).val(),
	                },
	                dataType: "html"
	            });
	
	            request.done(function(msg) {
	            	var customer = JSON.parse(msg);
	            	$("#Customer_FullName").val(customer.FullName);
	            	$("#Customer_DNI").val(customer.DNI);
	            	$("#Customer_Phone").val(customer.Phone);
	            	$("#Customer_Email").val(customer.Email);
	            	$("#Customer_BirthDate").val(customer.BirthDate);
	            	$("#Customer_Address").val(customer.Address);
	            	$("#Customer_Comments").val(customer.Comments);
	            });
			}
		});
		
		$("#btnImprimir").click(function(){
			window.location = "<?php echo Yii::app()->createURL('invoice/invoice/print/', array('id'=>$model->ID)); ?>";
		});
		
		// Add Extra to Book
		$("#addCharge").click(function(){
			if($("#chargeName").val() != "" || $("#chargeValue").val() != "")
			{
				var request = $.ajax({
		                url: "<?php echo $this->createURL("invoice/addCharge"); ?>",
		                type: "POST",
		                dataType: "html",
						data: {
							invoice : <?php echo $model->ID == "" ? 0 : $model->ID; ?>,
							charge : $("#chargeName").val(), 
							value : $("#chargeValue").val()
						}
		        });
		
		        request.done(function(msg) {
		        		$("#concepts").html(msg);
		        });
			}else{
				alert("Debe rellenar todos los campos del suplemento");
			}
		});
		
		// Delete Extra from Book
		$(".deleteCharge").click(function(){
			
			if(confirm("\u00bfSeguro que quieres eliminar este concepto?"))
			{
				var request = $.ajax({
		                url: "<?php echo $this->createURL("invoice/deleteCharge"); ?>",
		                type: "POST",
		                dataType: "html",
						data: {
							charge : $(this).attr("id"),
							invoice : <?php echo $model->ID == "" ? 0 : $model->ID; ?>
						}
		        });
		
		        request.done(function(msg) {
		        		$("#concepts").html(msg);
		        });
		    }
		    
		});
	});
	
</script>