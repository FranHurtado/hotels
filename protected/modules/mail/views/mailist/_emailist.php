<?php $modelEmails = CustomerList::model()->findAllByAttributes(array("ListID"=>$model->ID)); ?>

<ul style="list-style-type:none;padding-left:0.5em;">

<?php 
	foreach($modelEmails as $email):
	
	$customer = Customer::model()->findByPK($email->CustomerID);
?>
	
	<li><span class='delete' id='<?php echo $email->ID; ?>'>X</span><?php echo $customer->Email; ?> (<?php echo $customer->FullName; ?>)</li>

<?php	
	endforeach; 
?>

</ul>

<script>
	$(".delete").bind("click", function(){
		$("#content").css({"opacity" : 0.2});
		
		var request = $.ajax({
            url: "<?php echo $this->createURL("mailist/deletecustomer"); ?>",
            type: "POST",
            data: {
                listID : $(this).attr("id"), 
            },
            dataType: "html"
        });

        request.done(function(msg) {
            $("#content").css({"opacity" : 1});
        });
	});
</script>