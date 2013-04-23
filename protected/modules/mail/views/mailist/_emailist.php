<?php 
	$criteria = new CDbCriteria();
	$criteria->condition = "UserID = :userid";
	$criteria->params = array(':userid' => Yii::app()->user->ID);
	
	$modelCustomers = Customer::model()->findAll($criteria); 
?>

<ul style="list-style-type:none;padding-left:0.5em;">
	
	<li><input type="checkbox" class="customerEmailAll" value="0" /> Seleccionar todos<br /><br /></li>

<?php 
	foreach($modelCustomers as $customer):
	
	$checked = count(CustomerList::model()->findAllByAttributes(array("ListID"=>$model->ID, "CustomerID"=>$customer->ID))) > 0 ? "checked" : "";
?>
	
	<li><input type="checkbox" class="customerEmail" <?php echo $checked;?> value="<?php echo $customer->ID; ?>" /> <?php echo $customer->Email; ?> (<?php echo $customer->FullName; ?>)</li>

<?php	
	endforeach; 
?>

</ul>