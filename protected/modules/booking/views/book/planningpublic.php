<?php
/* @var $this BookController */
/* @var $model Book */

?>

<h1 class="header">Disponibilidad - <?php echo User::model()->findByPK($_GET["id"])->name; ?></h1>

<?php 



$this->widget('ext.planning.EPlanning', array(
    'model' => $model,
    'books' => $modelBooks,
)); 

?>

<script>
	$(document).ready(function(){
		$(".roomDay").unbind();
		$(".roomDayBooked").unbind();
		$(".roomDay").unbind();
		
		$(".roomDayBooked").each(function(){
			$(this).attr("title", "Ocupada");
			$(this).css({'background' : 'red'});
		});
	});
</script>