<?php
/* @var $this MailController */
/* @var $model Mail */

$this->breadcrumbs=array(
	'Marketing'=>array('admin'),
	'Listado',
);

$this->menu=array(
	array('label'=>'Crear Boletin', 'url'=>array('create')),
	array('label'=>'Crear Lista de envio', 'url'=>array('mailist/create')),
	array('label'=>'Listas de envio', 'url'=>array('mailist/admin')),
);

$this->help='Para enviar un bolet&iacute;n, primero crea una lista de envio con los clientes a los que lo quieres enviar.<br /><br />
				Posteriormente puedes crear el bolet&iacute;n y enviarlo.';

?>

<h1 class="header">Listado de boletines</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'Name',
            'filter'=> CHtml::activeTextField($model, 'Name', 
                 			array('placeholder'=>'Escribe el valor a buscar...')),
            'headerHtmlOptions'=>array(
                'style'=>'width:30%;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:30%;text-align:left;',
            ),
        ),
		array(
            'name'=>'ListID',
            'filter'=> false,
            'value'=>'$data->list->Name',
            'headerHtmlOptions'=>array(
                'style'=>'width:25%;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:25%;text-align:left;',
            ),
        ),
		array(
            'name'=>'Date',
            'filter'=> false,
            'value'=>'date("d-m-Y", strtotime($data->Date))',
            'headerHtmlOptions'=>array(
                'style'=>'width:15%;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:15%;text-align:left;',
            ),
        ),
        array(
            'name'=>'LastSent',
            'filter'=> false,
            'value'=>'$data->LastSent != NULL ? date("d-m-Y", strtotime($data->LastSent)) : "No enviado"',
            'headerHtmlOptions'=>array(
                'style'=>'width:20%;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:20%;text-align:left;',
            ),
        ),
		array(	
	        'class'=>'CButtonColumn',
	        'template'=>'{send} {update} {delete}',
	        'buttons' => array(
	            'send' => array(
	            	'label' => 'Enviar boletin',
	            	'url'=>'Yii::app()->createURL("mail/mail/send", array(id=>$data->ID))',
	            	'imageUrl' => Yii::app()->baseURL . '/images/send.png',
	            	'options'=>array(
	            				'style'=>'margin-right: 3px;',
            					'ajax' => array(
            								'type' => 'get', 
            								'async'=>'false',
            								'url'=>'js:$(this).attr("href")', 
            								'success' => 'js:function(data) { alert("El boletin se ha enviado correctamente."); }'
            								)
            					)
	            ),
	            'update' => array(
	            	'label' => 'Editar',
	            	'imageUrl' => Yii::app()->baseURL . '/images/edit.png',
	            ),
	            'delete' => array(
	            	'label' => 'Borrar',
	                'imageUrl' => Yii::app()->baseURL . '/images/delete.png',
	            ),
	        ),
	        'deleteConfirmation'=>'Si aceptas eliminaras este registro definitivamente.',
	     ),
	),
	
	'emptyText' => 'No hay registros. <a href="'.$this->createURL('create').'">Pincha</a> para crear uno.',
    'summaryText' => 'Mostrando del {start} al {end} de {count} registro(s).',
    
)); ?>


<script>
	function sendMail(id){
		$("#mailist").css({"opacity" : 0.2});
		
		var request = $.ajax({
            url: "<?php echo $this->createURL("mail/send/id"); ?>/" + id,
            type: "POST",
            dataType: "html"
        });

        request.done(function(msg) {

        });
	}
</script>
