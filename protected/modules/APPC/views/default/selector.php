<h1>Generar informe de APPC</h1>
<div class="form" style="margin: 0 auto;">
	<form method="post" name="form-selector" action="<?php echo Yii::app()->createUrl("APPC/default/informe"); ?>">
		<div style="float:left;">
			<label for="start" style="padding-bottom: 5px;">Selecciona el inicio del informe: </label>
			<?php
	            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	              'name'=>'start',
	              // additional javascript options for the date picker plugin
	              'options'=>array(
	                'changeYear'=>true,
	                'yearRange'=>'2000',
	                'language'=>'es',
	                'dateFormat'=>'dd-mm-yy',
	                'monthNames' => array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"),
	                'monthNamesShort' => array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),
	                'dayNames' => array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"),
	                'dayNamesMin' => array('Do','Lu','Ma','Mi','Ju','Vi','Sa'),
	                'defaultDate'=>$model->Date,
	              ),
	              'htmlOptions'=>array(
	                'placeholder'=>date("d-m-Y"),
	                'id'=>'start'
	              ),
	            ));
	        ?>
		</div>
		
		<div style="float:left;margin-left:50px;">
			<label for="start" style="padding-bottom: 5px;">Selecciona el final del informe: </label>
			<?php
	            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	              'name'=>'fin',
	              // additional javascript options for the date picker plugin
	              'options'=>array(
	                'changeYear'=>true,
	                'yearRange'=>'2000',
	                'language'=>'es',
	                'dateFormat'=>'dd-mm-yy',
	                'monthNames' => array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"),
	                'monthNamesShort' => array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),
	                'dayNames' => array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"),
	                'dayNamesMin' => array('Do','Lu','Ma','Mi','Ju','Vi','Sa'),
	                'defaultDate'=>$model->Date,
	              ),
	              'htmlOptions'=>array(
	                'placeholder'=>date("d-m-Y"),
	                'id'=>'fin'
	              ),
	            ));
	        ?>
		</div>
		
		<div class="row buttons" style="float:left;margin-left:50px;">
			<?php echo CHtml::submitButton('Generar'); ?>
		</div>
		
		<div style="clear:both;"></div>
	</form>
</div>

<a href="<?php echo Yii::app()->createURL("APPC"); ?>" class="backButtonA">Volver</a>