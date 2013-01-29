<?php
/* @var $this MailController */
/* @var $model Mail */

$this->breadcrumbs=array(
	'Marketing'=>array('admin'),
	'Listado',
);

$this->menu=array(
	array('label'=>'Crear Boletin', 'url'=>array('create')),
	array('label'=>'Ver Listas de envio', 'url'=>array('mailist/admin')),
);

?>

<h1 class="header">Listado de boletines</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'Name',
            'headerHtmlOptions'=>array(
                'style'=>'width:250px;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:250px;text-align:left;',
            ),
        ),
		array(
            'name'=>'ListID',
            'value'=>'$data->list->Name',
            'headerHtmlOptions'=>array(
                'style'=>'width:150px;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:150px;text-align:left;',
            ),
        ),
		array(
            'name'=>'Date',
            'value'=>'date("d-m-Y", strtotime($data->Date))',
            'headerHtmlOptions'=>array(
                'style'=>'width:100px;text-align:left !important;',
            ),
            'htmlOptions'=>array(
                'style'=>'width:100px;text-align:left;',
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
