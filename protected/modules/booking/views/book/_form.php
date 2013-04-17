<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $form CActiveForm */
?>

<?php
	$criteria = new CDbCriteria();
	$criteria->condition = "UserID = :userid";
	$criteria->params = array(':userid' => Yii::app()->user->ID);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary(array($model,$modelCustomer)); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'UserID',array('value'=>Yii::app()->user->ID)); ?>
	</div>

	<div class="row" style="width: 15%; float: left;">
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

	<div class="row" style="width: 15%; float: left; margin-left: 5%;">
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
	
	<div class="row" style="width: 25%; float: left; margin-left: 5%;">
		<?php echo $form->labelEx($model,'RoomID'); ?>
		<?php echo $form->dropDownList($model,'RoomID', CHtml::listData(Room::model()->findAll($criteria), 'ID', 'Name'), 
											array('empty'=>'-- Selecciona la habitacion --', 'style' => 'width: 100%;')); ?>
		<?php echo $form->error($model,'RoomID'); ?>
	</div>
	
	<div class="row" style="width: 18%; float: left; margin-left: 8%;">
		<h1 style="font-size: 18pt !important;">Total: <span style="font-size: 28pt !important;" id="pvp">0</span>&euro;</h1>
	</div>
	
	<div style="clear:both;"></div>
	
	<div class="row" style="width: 15%; float: left;">
		<?php echo $form->labelEx($model,'Pax'); ?>
		<?php echo $form->textField($model,'Pax',array('maxlength'=>2, 'style'=>'width:15%;')); ?>
		<?php echo $form->error($model,'Pax'); ?>
	</div>
	
	<div style="clear:both;"></div><br /><br />
	
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
		
	</div>

	<!--<div class="row">
		<?php //echo $form->labelEx($model,'SeasonID'); ?>
		<?php //echo $form->textField($model,'SeasonID'); ?>
		<?php //echo $form->error($model,'SeasonID'); ?>
	</div>-->
	
	<br /><br />
	
	<h1>Suplementos y descuentos</h1>

	<div id="ConceptForm" style="padding: 10px 25px;border: 1px solid #dddddd;">
	
		<?php if($model->isNewRecord == true): ?>
		
		<p style="color:red;font-size:12pt;">Guarda la reserva para poder a&ntilde;adir descuentos y suplementos</p>
		
		<?php else: ?>
	
		<div style="width:60%; float:left;">
	
			<div class="row" style="width:50%;float:left;">
				<?php echo CHtml::label('Nombre suplemento','extraName'); ?>
				<?php echo CHtml::textField('extraName','',array('maxlength'=>150, 'style'=>'width:100%;')); ?>
			</div>
			<div class="row" style="width:5%;float:left;margin-left:5%;">
				<?php echo CHtml::label('&euro;','extraValue',array('style'=>'width:100%;text-align:center;padding-left:20%;')); ?>
				<?php echo CHtml::textField('extraValue','',array('maxlength'=>5, 'style'=>'width:100%;')); ?>
			</div>
			<div class="row" style="width:10%;float:left;margin-left:5%;">
				<?php echo CHtml::button('Contabilizar',array('id'=>'addExtra','style'=>'margin-top: 12px;')); ?>
			</div>
			
			<div style="clear:both"></div>
			
			<div class="row" style="width:50%;float:left;">
				<?php echo CHtml::label('Nombre descuento','discountName'); ?>
				<?php echo CHtml::textField('discountName','',array('maxlength'=>150, 'style'=>'width:100%;')); ?>
			</div>
			<div class="row" style="width:5%;float:left;margin-left:5%;">
				<?php echo CHtml::label('%','discountValue',array('style'=>'width:100%;text-align:center;padding-left:20%;')); ?>
				<?php echo CHtml::textField('discountValue','',array('maxlength'=>3, 'style'=>'width:100%;')); ?>
			</div>
			<div class="row" style="width:10%;float:left;margin-left:5%;">
				<?php echo CHtml::button('Contabilizar',array('id'=>'addDiscount','style'=>'margin-top: 12px;')); ?>
			</div>
			
			<div style="clear:both"></div>
		
		</div>
		
		<div style="width:35%; float:right;" id="extraDiscount">
			
			<?php
			$criteria = new CDbCriteria();
			$criteria->condition = "UserID = :userid AND BookID = :bookid";
			$criteria->params = array(':userid' => Yii::app()->user->ID, ':bookid' => $model->ID);
			
			$modelExtra = Extra::model()->findAll($criteria);
			$modelDiscount = Discount::model()->findAll($criteria);
			
			echo "<h2 class='extra'>Suplementos</h2>";
			if(count($modelExtra) == 0): echo "<p>No hay suplementos</p>"; endif;
			foreach($modelExtra as $extra):
				echo "<p><span class='deleteExtra' id='". $extra->ID ."'>X</span> " . $extra->Name . " (" . str_replace(',','.',$extra->Value) . "&euro;)</p>";
			endforeach;
			
			echo "<h2 class='extra'>Descuentos</h2>";
			if(count($modelDiscount) == 0): echo "<p>No hay suplementos</p>"; endif;
			foreach($modelDiscount as $discount):
				echo "<p><span class='deleteDiscount' id='". $discount->ID ."'>X</span> " . $discount->Name . " (" . $discount->Value . "%)</p>";
			endforeach;	
			?>
		
		</div>
		
		<div style="clear:both"></div>
		
		<?php endif; ?>
		
	</div>

	<div class="row buttons">
		<?php if($model->Type == 0): ?>
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?> &nbsp;&nbsp;
			<?php echo CHtml::button('Cobrar', array('id'=>'btnCobrar')); ?>
		<?php else: ?>
			<?php echo CHtml::button('Imprimir factura', array('id'=>'btnImprimir')); ?>
		<?php endif; ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	
	$(document).ready(function(){
		<?php if($model->isNewRecord == false): ?>
		
		calculaPrecio($("#Book_Start").val(), $("#Book_Finish").val(), $("#Book_RoomID").val(), $("#Book_Pax").val());
		
		<?php endif; ?>
		
		// Fill form on Customer change
		$("#Book_CustomerID").change(function(){
			if($(this).value != "")
			{
				var request = $.ajax({
	                url: "<?php echo $this->createURL("book/fillcustomer"); ?>",
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
		
		function calculaPrecio(start,finish,room,pax)
		{
			var request = $.ajax({
                url: "<?php echo $this->createURL("book/calculateprice"); ?>",
                type: "POST",
                data: {
                    start : start,
                    finish : finish,
                    room : room,
                    pax : pax,
                    book : <?php echo $model->ID == "" ? 0 : $model->ID; ?>
                },
                dataType: "html"
            });

            request.done(function(msg) {
            	$("#pvp").html(msg);
            });
		}
		
		// Calculate price on Start date change
		$("#Book_Start").change(function(){
			if(($("#Book_Start").val() != "") && ($("#Book_Finish").val() != "") && ($("#Book_RoomID").val() != ""))
			{
				calculaPrecio($("#Book_Start").val(), $("#Book_Finish").val(), $("#Book_RoomID").val(), $("#Book_Pax").val());
			}
			else
			{
				return false;
			}
		});
		
		// Calculate price on Finish date change
		$("#Book_Finish").change(function(){
			if(($("#Book_Start").val() != "") && ($("#Book_Finish").val() != "") && ($("#Book_RoomID").val() != ""))
			{
				calculaPrecio($("#Book_Start").val(), $("#Book_Finish").val(), $("#Book_RoomID").val(), $("#Book_Pax").val());
			}
			else
			{
				return false;
			}
		});
		
		// Calculate price on Room change
		$("#Book_RoomID").change(function(){
			if(($("#Book_Start").val() != "") && ($("#Book_Finish").val() != "") && ($("#Book_RoomID").val() != ""))
			{
				calculaPrecio($("#Book_Start").val(), $("#Book_Finish").val(), $("#Book_RoomID").val(), $("#Book_Pax").val());
			}
			else
			{
				return false;
			}
		});
		
		// Add Extra to Book
		$("#addExtra").click(function(){
			if($("#extraName").val() != "" || $("#extraValue").val() != "")
			{
				var request = $.ajax({
		                url: "<?php echo $this->createURL("book/addExtra"); ?>",
		                type: "POST",
		                dataType: "html",
						data: {
							book : <?php echo $model->ID == "" ? 0 : $model->ID; ?>,
							extra : $("#extraName").val(), 
							value : $("#extraValue").val()
						}
		        });
		
		        request.done(function(msg) {
		        		$("#extraDiscount").html(msg);
		        		calculaPrecio($("#Book_Start").val(), $("#Book_Finish").val(), $("#Book_RoomID").val(), $("#Book_Pax").val());
		        });
			}else{
				alert("Debe rellenar todos los campos del suplemento");
			}
		});
		
		// Add Discount to Book
		$("#addDiscount").click(function(){
			if($("#discountName").val() != "" || $("#discountValue").val() != "")
			{
				var request = $.ajax({
		                url: "<?php echo $this->createURL("book/addDiscount"); ?>",
		                type: "POST",
		                dataType: "html",
						data: {
							book : <?php echo $model->ID == "" ? 0 : $model->ID; ?>,
							discount : $("#discountName").val(), 
							value : $("#discountValue").val()
						}
		        });
		
		        request.done(function(msg) {
		        		$("#extraDiscount").html(msg);
		        		calculaPrecio($("#Book_Start").val(), $("#Book_Finish").val(), $("#Book_RoomID").val(), $("#Book_Pax").val());
		        });
			}else{
				alert("Debe rellenar todos los campos del descuento");
			}
		});
		
		// Delete Extra from Book
		$(".deleteExtra").click(function(){
			
			if(confirm("\u00bfSeguro que quieres eliminar este suplemento?"))
			{
				var request = $.ajax({
		                url: "<?php echo $this->createURL("book/deleteExtra"); ?>",
		                type: "POST",
		                dataType: "html",
						data: {
							extra : $(this).attr("id"),
							book : <?php echo $model->ID == "" ? 0 : $model->ID; ?>
						}
		        });
		
		        request.done(function(msg) {
		        		$("#extraDiscount").html(msg);
		        		calculaPrecio($("#Book_Start").val(), $("#Book_Finish").val(), $("#Book_RoomID").val(), $("#Book_Pax").val());
		        });
		    }
		    
		});
		
		// Delete Discount from Book
		$(".deleteDiscount").click(function(){
		
			if(confirm("\u00bfSeguro que quieres eliminar este descuento?"))
			{
				var request = $.ajax({
		                url: "<?php echo $this->createURL("book/deleteDiscount"); ?>",
		                type: "POST",
		                dataType: "html",
						data: {
							discount : $(this).attr("id"),
							book : <?php echo $model->ID == "" ? 0 : $model->ID; ?>
						}
		        });
		
		        request.done(function(msg) {
		        		$("#extraDiscount").html(msg);
		        		calculaPrecio($("#Book_Start").val(), $("#Book_Finish").val(), $("#Book_RoomID").val(), $("#Book_Pax").val());
		        });
		    }

		});
		
		// Load invoice screen
		$("#btnCobrar").click(function(){ 
		 	if(($("#Book_Start").val() != "") && ($("#Book_Finish").val() != "") && ($("#Book_RoomID").val() != "") && ($("#Book_CustomerID").val() != ""))
		 	{
		    	function loadCobro(responseText, statusText, xhr, $form) {
					window.location = "<?php echo Yii::app()->createURL('booking/book/billing/', array('id'=>$model->ID)); ?>";
				    return true;
				} 
			    
			    var options = { 
			        success: loadCobro,  // post-submit callback 
			        error: function(response, status, err){
						        alert(response.status);
						    }
			    };
			    
		    	$('#book-form').ajaxForm(options);
		    	
		    	$('#book-form').submit();
		    }
		    else
		    {
			    alert("Debe rellenar todos los datos de la reserva para poder cobrarla.");
		    }
		});
	});
	
</script>