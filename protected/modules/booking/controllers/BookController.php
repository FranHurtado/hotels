<?php

class BookController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		$Admin = "isset(Yii::app()->user->role) && (Yii::app()->user->role==='admin')";
		$User  = "isset(Yii::app()->user->role) && (Yii::app()->user->role==='user')";
            
        return array(
        	array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete','admin','fillcustomer','planning','calculateprice',
									'billing','addExtra','addDiscount','deleteExtra','deleteDiscount','generate','generateprint'),
				'users'=>array('@'),
                'expression'=>$User,
			),
            
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete','admin','fillcustomer','planning','calculateprice',
									'billing','addExtra','addDiscount','deleteExtra','deleteDiscount','generate','generateprint'),
				'users'=>array('@'),
                'expression'=>$Admin,
			),
			array('allow',  // allow all users
				'actions'=>array('planningpublic'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Book;
		$modelCustomer=new Customer;
		
		if($_GET["id"] != "" && $_GET["d"] != ""):
			$model->RoomID = $_GET["id"];
			$model->Start = date("Y-m-d", $_GET["d"]);
		endif;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Book']))
		{
			$model->attributes=$_POST['Book'];
			
			// Check if the Room is booked
			if(strtotime($model->Finish) - strtotime($model->Start) > 86400): // More than 1 day
				$j = ((strtotime($model->Finish) - strtotime($model->Start)) / 86400);
				for($i = 0; $i<$j; $i++):
					$theDate = strtotime($model->Start) + ($i * 86400);
					
					$criteria = new CDbCriteria();
					$criteria->condition = "(:start BETWEEN Start AND Finish) AND RoomID = :roomid AND UserID = :userid";
					$criteria->params = array(':start' => date("Y-m-d", $theDate), ':roomid' => $model->RoomID, ':userid' => Yii::app()->user->ID);
					
					if(count(Book::model()->find($criteria))>0):
						$model->addError('Name', 'Ya existe una reserva para el rango de fechas en esta misma habitaci&oacute;n.');
						$this->render('create',array(
							'model'=>$model,
							'modelCustomer'=>$modelCustomer,
						));
						exit;
					endif;
				endfor;
			else : // One day booking

			endif;
			
			// Room is not booked then...

			// Si creamos un nuevo Customer hay que guardarlo
			if(strlen($model->CustomerID) == 0):
				$modelCustomer->attributes=$_POST['Customer'];
				$modelCustomer->UserID = Yii::app()->user->ID;
				if($modelCustomer->save()):
					$model->CustomerID = $modelCustomer->ID;
				endif;
			else:
				$modelCustomer = Customer::model()->findByPK($model->CustomerID);
				$modelCustomer->attributes=$_POST['Customer'];
				$modelCustomer->UserID = Yii::app()->user->ID;
				$modelCustomer->save();
			endif;
			
			$model->SeasonID = Book::model()->getSeason($model->Start);
			
			if($model->save())
				$this->redirect(array('update', 'id'=>$model->ID));
			
		}

		$this->render('create',array(
			'model'=>$model,
			'modelCustomer'=>$modelCustomer,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$modelCustomer = Customer::model()->findByPK($model->CustomerID);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Book']))
		{
			$model->attributes=$_POST['Book'];
			
			// Si creamos un nuevo Customer hay que guardarlo
			if(strlen($model->CustomerID) == 0) :
				$modelCustomer->attributes=$_POST['Customer'];
				$modelCustomer->UserID = Yii::app()->user->ID;
				if($modelCustomer->save()):
					$model->CustomerID = $modelCustomer->ID;
				endif;
			else :
				$modelCustomer = Customer::model()->findByPK($model->CustomerID);
				$modelCustomer->attributes=$_POST['Customer'];
				$modelCustomer->UserID = Yii::app()->user->ID;
				$modelCustomer->save();
			endif;
			
			$model->SeasonID = Book::model()->getSeason($model->Start);
			
			if($model->save())
				$this->redirect(array('planning'));
		}

		$this->render('update',array(
			'model'=>$model,
			'modelCustomer'=>$modelCustomer,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Book');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Book('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Book']))
			$model->attributes=$_GET['Book'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Planning.
	 */
	public function actionPlanning()
	{
		$model=new Book('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Book']))
			$model->attributes=$_GET['Book'];

		$this->render('planning',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Planning Public.
	 */
	public function actionPlanningPublic($id)
	{
		$this->layout = "//layouts/public";
		
		$criteriaRooms = new CDbCriteria();
		$criteriaRooms->condition = 'UserID = :userid';
		$criteriaRooms->params = array(':userid' => $id);
		$criteriaRooms->order = 'Name Desc';
		
		$criteriaBooks = new CDbCriteria();
		$criteriaBooks->condition = 'UserID = :userid';
		$criteriaBooks->params = array(':userid' => $id);
		$criteriaBooks->order = 'ID';
		
		$model = Room::model()->findAll($criteriaRooms);
		$modelBooks = Book::model()->findAll($criteriaBooks);

		$this->render('planningpublic',array(
			'model'=>$model,
			'modelBooks'=>$modelBooks,
		));
	}
	
	/**
	* Calculate Price
	*/
	public function actionCalculatePrice()
	{
		$startDate = strtotime($_POST["start"]);
		$finishDate = strtotime($_POST["finish"]);
		$roomID = $_POST["room"];
		$Pax = $_POST["pax"];
		
		$days = round(($finishDate - $startDate) / 86400);
		
		$price = 0;
		
		
		// Calculate Room price
		if(Room::model()->findByPK($roomID)->Type == 0):
			for($i=0;$i<$days;$i++):
				$date = $startDate + ($i * 86400);
				$season = Book::model()->getSeason(date("Y-m-d", $date));
				
				switch($season):
					case 0:
						$price = $price + Room::model()->findByPK($roomID)->PriceLow;
						break;
					case 1:
						$price = $price + Room::model()->findByPK($roomID)->PriceMed;
						break;
					case 2:
						$price = $price + Room::model()->findByPK($roomID)->PriceBig;
						break;
				endswitch;
				
			endfor;
		else:
			for($i=0;$i<$days;$i++):
				$date = $startDate + ($i * 86400);
				$season = Book::model()->getSeason(date("Y-m-d", $date));
				
				switch($season):
					case 0:
						$price = $price + (Room::model()->findByPK($roomID)->PriceLow * $Pax);
						break;
					case 1:
						$price = $price + (Room::model()->findByPK($roomID)->PriceMed * $Pax);
						break;
					case 2:
						$price = $price + (Room::model()->findByPK($roomID)->PriceBig * $Pax);
						break;
				endswitch;
				
			endfor;
		endif;
		
		// Add extras to price
		if($_POST["book"] > 0):
			$criteria = new CDbCriteria();
			$criteria->condition = "UserID = :userid AND BookID = :bookid";
			$criteria->params = array(':userid' => Yii::app()->user->ID, ':bookid' => $_POST["book"]);
			
			$modelExtra = Extra::model()->findAll($criteria);
			
			foreach($modelExtra as $extra):
				$price = $price + $extra->Value;
			endforeach;
		endif;
		
		// Apply discount to price
		if($_POST["book"] > 0):
			$modelDiscount = Discount::model()->findAll($criteria);
			
			foreach($modelDiscount as $discount):
				$price = $price + (-($discount->Value * $price) / 100);
			endforeach;
		endif;
		
		echo str_replace('.',',',$price);
	}
	
	
	/**
	*	Billing Preview
	*/
	public function actionBilling()
	{
		$model = Book::model()->findByPK($_GET["id"]);
		$items = Array();
		$startDate = strtotime($model->Start);
		$finishDate = strtotime($model->Finish);
		$roomID = $model->RoomID;
		$Pax = $model->Pax;
		
		$days = round(($finishDate - $startDate) / 86400);
		
		$price = 0;
		
		
		// Calculate Room price
		if(Room::model()->findByPK($roomID)->Type == 0):
			for($i=0;$i<$days;$i++):
				$date = $startDate + ($i * 86400);
				$season = Book::model()->getSeason(date("Y-m-d", $date));
				
				switch($season):
					case 0:
						$items[] = array($model->room->PriceLow, $model->room->Name . " (Temporada Baja).");
						$price = $price + Room::model()->findByPK($roomID)->PriceLow;
						break;
					case 1:
						$items[] = array($model->room->PriceMed, $model->room->Name . " (Temporada Media).");
						$price = $price + Room::model()->findByPK($roomID)->PriceMed;
						break;
					case 2:
						$items[] = array($model->room->PriceBig, $model->room->Name . " (Temporada Alta).");
						$price = $price + Room::model()->findByPK($roomID)->PriceBig;
						break;
				endswitch;
				
			endfor;
		else:
			for($i=0;$i<$days;$i++):
				$date = $startDate + ($i * 86400);
				$season = Book::model()->getSeason(date("Y-m-d", $date));
				
				switch($season):
					case 0:
						$items[] = array((Room::model()->findByPK($roomID)->PriceLow * $Pax), $model->room->Name . " (" . $Pax . " personas Temporada Baja).");
						$price = $price + (Room::model()->findByPK($roomID)->PriceLow * $Pax);
						break;
					case 1:
						$items[] = array((Room::model()->findByPK($roomID)->PriceMed * $Pax), $model->room->Name . " (" . $Pax . " personas Temporada Media).");
						$price = $price + (Room::model()->findByPK($roomID)->PriceMed * $Pax);
						break;
					case 2:
						$items[] = array((Room::model()->findByPK($roomID)->PriceBig * $Pax), $model->room->Name . " (" . $Pax . " personas Temporada Alta).");
						$price = $price + (Room::model()->findByPK($roomID)->PriceBig * $Pax);
						break;
				endswitch;
				
			endfor;
		endif;
		
		// Add extras to price
		if($model->ID > 0):
			$criteria = new CDbCriteria();
			$criteria->condition = "UserID = :userid AND BookID = :bookid";
			$criteria->params = array(':userid' => Yii::app()->user->ID, ':bookid' => $model->ID);
			
			$modelExtra = Extra::model()->findAll($criteria);
			
			foreach($modelExtra as $extra):
				$items[] = array($extra->Value, $extra->Name . " (Suplemento)");
				$price = $price + $extra->Value;
			endforeach;
		endif;
		
		// Apply discount to price
		if($model->ID > 0):
			$modelDiscount = Discount::model()->findAll($criteria);
			
			foreach($modelDiscount as $discount):
				$items[] = array((-($discount->Value * $price) / 100), $discount->Name . " (Descuento ". $discount->Value ."%)");
				$price = $price + (-($discount->Value * $price) / 100);
			endforeach;
		endif;
		
		$this->render('billing', array('model'=>$model,'items'=>$items, 'price'=>$price));
		
	}
	
	
	/**
	*	Billing
	*/
	public function actionGenerate()
	{
		$model = Book::model()->findByPK($_GET["id"]);
		// Change Book status
		$model->Type = 1;
		$model->save();
		
		$items = Array();
		$startDate = strtotime($model->Start);
		$finishDate = strtotime($model->Finish);
		$roomID = $model->RoomID;
		$Pax = $model->Pax;
		
		// Create Invoice
		$modelInvoice = new Invoice;
		$modelInvoice->UserID = Yii::app()->user->ID;
		$modelInvoice->CustomerID = $model->CustomerID;
		$modelInvoice->Date = date("Y-m-d");
		$criteriaNextNumber = new CDbCriteria();
		$criteriaNextNumber->condition = 'UserID = :userid';
		$criteriaNextNumber->params = array(':userid' => Yii::app()->user->ID);
		$criteriaNextNumber->order = 'Number Desc'; 
		$modelInvoice->Number = Invoice::model()->find($criteriaNextNumber)->ID + 1;
		$modelInvoice->SerieID = Serie::model()->findByAttributes(array('Pred'=>'1'))->ID;
		$modelInvoice->BookID = $model->ID;
		
		$modelInvoice->save();
		
		
		$days = round(($finishDate - $startDate) / 86400);
		
		$price = 0;
		
		
		// Calculate Room price
		if(Room::model()->findByPK($roomID)->Type == 0):
			for($i=0;$i<$days;$i++):
				$date = $startDate + ($i * 86400);
				$season = Book::model()->getSeason(date("Y-m-d", $date));
				
				$modelCharge= new Charge;
				$modelCharge->UserID = Yii::app()->user->ID;
				$modelCharge->InvoiceID = $modelInvoice->ID;
				$modelCharge->IVA = User::model()->findByPK(Yii::app()->user->ID)->IVA;
				
				switch($season):
					case 0:
						$items[] = array($model->room->PriceLow, $model->room->Name . " (Temporada Baja).");
						$price = $price + Room::model()->findByPK($roomID)->PriceLow;
						$modelCharge->Text = $model->room->Name . " (Temporada Baja).";
						$modelCharge->Price = Room::model()->findByPK($roomID)->PriceLow;
						break;
					case 1:
						$items[] = array($model->room->PriceMed, $model->room->Name . " (Temporada Media).");
						$price = $price + Room::model()->findByPK($roomID)->PriceMed;
						$modelCharge->Text = $model->room->Name . " (Temporada Media).";
						$modelCharge->Price = Room::model()->findByPK($roomID)->PriceMed;
						break;
					case 2:
						$items[] = array($model->room->PriceBig, $model->room->Name . " (Temporada Alta).");
						$price = $price + Room::model()->findByPK($roomID)->PriceBig;
						$modelCharge->Text = $model->room->Name . " (Temporada Alta).";
						$modelCharge->Price = Room::model()->findByPK($roomID)->PriceBig;
						break;
				endswitch;
				
				$modelCharge->save();
				
			endfor;
		else:
			for($i=0;$i<$days;$i++):
				$date = $startDate + ($i * 86400);
				$season = Book::model()->getSeason(date("Y-m-d", $date));
				
				$modelCharge= new Charge;
				$modelCharge->UserID = Yii::app()->user->ID;
				$modelCharge->InvoiceID = $modelInvoice->ID;
				$modelCharge->IVA = User::model()->findByPK(Yii::app()->user->ID)->IVA;
				
				switch($season):
					case 0:
						$items[] = array((Room::model()->findByPK($roomID)->PriceLow * $Pax), $model->room->Name . " (" . $Pax . " personas Temporada Baja).");
						$price = $price + (Room::model()->findByPK($roomID)->PriceLow * $Pax);
						$modelCharge->Text = $model->room->Name . " (" . $Pax . " personas Temporada Baja).";
						$modelCharge->Price = (Room::model()->findByPK($roomID)->PriceLow * $Pax);
						break;
					case 1:
						$items[] = array((Room::model()->findByPK($roomID)->PriceMed * $Pax), $model->room->Name . " (" . $Pax . " personas Temporada Media).");
						$price = $price + (Room::model()->findByPK($roomID)->PriceMed * $Pax);
						$modelCharge->Text = $model->room->Name . " (" . $Pax . " personas Temporada Media).";
						$modelCharge->Price = (Room::model()->findByPK($roomID)->PriceMed * $Pax);
						break;
					case 2:
						$items[] = array((Room::model()->findByPK($roomID)->PriceBig * $Pax), $model->room->Name . " (" . $Pax . " personas Temporada Alta).");
						$price = $price + (Room::model()->findByPK($roomID)->PriceBig * $Pax);
						$modelCharge->Text = $model->room->Name . " (" . $Pax . " personas Temporada Alta).";
						$modelCharge->Price = (Room::model()->findByPK($roomID)->PriceBig * $Pax);
						break;
				endswitch;
				
				$modelCharge->save();
				
			endfor;
		endif;
		
		// Add extras to price
		if($model->ID > 0):
			$criteria = new CDbCriteria();
			$criteria->condition = "UserID = :userid AND BookID = :bookid";
			$criteria->params = array(':userid' => Yii::app()->user->ID, ':bookid' => $model->ID);
			
			$modelExtra = Extra::model()->findAll($criteria);
			
			foreach($modelExtra as $extra):
				$modelCharge= new Charge;
				$modelCharge->UserID = Yii::app()->user->ID;
				$modelCharge->InvoiceID = $modelInvoice->ID;
				$modelCharge->IVA = User::model()->findByPK(Yii::app()->user->ID)->IVA;
				
				$items[] = array($extra->Value, $extra->Name . " (Suplemento)");
				$modelCharge->Text = $extra->Name . " (Suplemento)";
				$modelCharge->Price = $extra->Value;
				$price = $price + $extra->Value;
				
				$modelCharge->save();
			endforeach;
		endif;
		
		// Apply discount to price
		if($model->ID > 0):
			$modelDiscount = Discount::model()->findAll($criteria);
			
			foreach($modelDiscount as $discount):
				$modelCharge= new Charge;
				$modelCharge->UserID = Yii::app()->user->ID;
				$modelCharge->InvoiceID = $modelInvoice->ID;
				$modelCharge->IVA = User::model()->findByPK(Yii::app()->user->ID)->IVA;
				
				$items[] = array((($discount->Value * $price) / 100), $discount->Name . " (Descuento)");
				$modelCharge->Text = $discount->Name . " (Descuento)";
				$modelCharge->Price = -(($discount->Value * $price) / 100);
				$price = $price + (-($discount->Value * $price) / 100);
				
				$modelCharge->save();
			endforeach;
		endif;
		
		$this->redirect(array('/invoice/invoice/admin'));
		
	}
	
	/**
	*	Billing and Print
	*/
	public function actionGeneratePrint()
	{
		$model = Book::model()->findByPK($_GET["id"]);
		// Change Book status
		$model->Type = 1;
		$model->save();
		
		$items = Array();
		$startDate = strtotime($model->Start);
		$finishDate = strtotime($model->Finish);
		$roomID = $model->RoomID;
		$Pax = $model->Pax;
		
		// Create Invoice
		$modelInvoice = new Invoice;
		$modelInvoice->UserID = Yii::app()->user->ID;
		$modelInvoice->CustomerID = $model->CustomerID;
		$modelInvoice->Date = date("Y-m-d");
		$criteriaNextNumber = new CDbCriteria();
		$criteriaNextNumber->condition = 'UserID = :userid';
		$criteriaNextNumber->params = array(':userid' => Yii::app()->user->ID);
		$criteriaNextNumber->order = 'Number Desc'; 
		$modelInvoice->Number = Invoice::model()->find($criteriaNextNumber)->ID + 1;
		$modelInvoice->SerieID = Serie::model()->findByAttributes(array('Pred'=>'1'))->ID;
		$modelInvoice->BookID = $model->ID;
		
		$modelInvoice->save();
		
		
		$days = round(($finishDate - $startDate) / 86400);
		
		$price = 0;
		
		
		// Calculate Room price
		if(Room::model()->findByPK($roomID)->Type == 0):
			for($i=0;$i<$days;$i++):
				$date = $startDate + ($i * 86400);
				$season = Book::model()->getSeason(date("Y-m-d", $date));
				
				$modelCharge= new Charge;
				$modelCharge->UserID = Yii::app()->user->ID;
				$modelCharge->InvoiceID = $modelInvoice->ID;
				$modelCharge->IVA = User::model()->findByPK(Yii::app()->user->ID)->IVA;
				
				switch($season):
					case 0:
						$items[] = array($model->room->PriceLow, $model->room->Name . " (Temporada Baja).");
						$price = $price + Room::model()->findByPK($roomID)->PriceLow;
						$modelCharge->Text = $model->room->Name . " (Temporada Baja).";
						$modelCharge->Price = Room::model()->findByPK($roomID)->PriceLow;
						break;
					case 1:
						$items[] = array($model->room->PriceMed, $model->room->Name . " (Temporada Media).");
						$price = $price + Room::model()->findByPK($roomID)->PriceMed;
						$modelCharge->Text = $model->room->Name . " (Temporada Media).";
						$modelCharge->Price = Room::model()->findByPK($roomID)->PriceMed;
						break;
					case 2:
						$items[] = array($model->room->PriceBig, $model->room->Name . " (Temporada Alta).");
						$price = $price + Room::model()->findByPK($roomID)->PriceBig;
						$modelCharge->Text = $model->room->Name . " (Temporada Alta).";
						$modelCharge->Price = Room::model()->findByPK($roomID)->PriceBig;
						break;
				endswitch;
				
				$modelCharge->save();
				
			endfor;
		else:
			for($i=0;$i<$days;$i++):
				$date = $startDate + ($i * 86400);
				$season = Book::model()->getSeason(date("Y-m-d", $date));
				
				$modelCharge= new Charge;
				$modelCharge->UserID = Yii::app()->user->ID;
				$modelCharge->InvoiceID = $modelInvoice->ID;
				$modelCharge->IVA = User::model()->findByPK(Yii::app()->user->ID)->IVA;
				
				switch($season):
					case 0:
						$items[] = array((Room::model()->findByPK($roomID)->PriceLow * $Pax), $model->room->Name . " (" . $Pax . " personas Temporada Baja).");
						$price = $price + (Room::model()->findByPK($roomID)->PriceLow * $Pax);
						$modelCharge->Text = $model->room->Name . " (" . $Pax . " personas Temporada Baja).";
						$modelCharge->Price = (Room::model()->findByPK($roomID)->PriceLow * $Pax);
						break;
					case 1:
						$items[] = array((Room::model()->findByPK($roomID)->PriceMed * $Pax), $model->room->Name . " (" . $Pax . " personas Temporada Media).");
						$price = $price + (Room::model()->findByPK($roomID)->PriceMed * $Pax);
						$modelCharge->Text = $model->room->Name . " (" . $Pax . " personas Temporada Media).";
						$modelCharge->Price = (Room::model()->findByPK($roomID)->PriceMed * $Pax);
						break;
					case 2:
						$items[] = array((Room::model()->findByPK($roomID)->PriceBig * $Pax), $model->room->Name . " (" . $Pax . " personas Temporada Alta).");
						$price = $price + (Room::model()->findByPK($roomID)->PriceBig * $Pax);
						$modelCharge->Text = $model->room->Name . " (" . $Pax . " personas Temporada Alta).";
						$modelCharge->Price = (Room::model()->findByPK($roomID)->PriceBig * $Pax);
						break;
				endswitch;
				
				$modelCharge->save();
				
			endfor;
		endif;
		
		// Add extras to price
		if($model->ID > 0):
			$criteria = new CDbCriteria();
			$criteria->condition = "UserID = :userid AND BookID = :bookid";
			$criteria->params = array(':userid' => Yii::app()->user->ID, ':bookid' => $model->ID);
			
			$modelExtra = Extra::model()->findAll($criteria);
			
			foreach($modelExtra as $extra):
				$modelCharge= new Charge;
				$modelCharge->UserID = Yii::app()->user->ID;
				$modelCharge->InvoiceID = $modelInvoice->ID;
				$modelCharge->IVA = User::model()->findByPK(Yii::app()->user->ID)->IVA;
				
				$items[] = array($extra->Value, $extra->Name . " (Suplemento)");
				$modelCharge->Text = $extra->Name . " (Suplemento)";
				$modelCharge->Price = $extra->Value;
				$price = $price + $extra->Value;

				
				$modelCharge->save();
			endforeach;
		endif;
		
		// Apply discount to price
		if($model->ID > 0):
			$modelDiscount = Discount::model()->findAll($criteria);
			
			foreach($modelDiscount as $discount):
				$modelCharge= new Charge;
				$modelCharge->UserID = Yii::app()->user->ID;
				$modelCharge->InvoiceID = $modelInvoice->ID;
				$modelCharge->IVA = User::model()->findByPK(Yii::app()->user->ID)->IVA;
				
				$items[] = array((-($discount->Value * $price) / 100), $discount->Name . " (Descuento)");
				$modelCharge->Text = $discount->Name . " (Descuento)";
				$modelCharge->Price = -(($discount->Value * $price) / 100);
				$price = $price + (-($discount->Value * $price) / 100);

				$modelCharge->save();
			endforeach;
		endif;
		
		
		// Print invoice
		set_time_limit(600);
    		
        # mPDF
        $pdf = Yii::app()->ePdf->mpdf('', 'A4', '','','','','','','','','P');

        $pdf->writeHTMLfooter=false;
        $pdf->writeHTMLheader=false;
        $pdf->DeflMargin=25;
        $pdf->DefrMargin=25;
        $pdf->tMargin=15;
        $pdf->bMargin=15;

        $pdf->w=297;   //manually set width
        $pdf->h=209.8; //manually set height
        
        $pdf->WriteHTML($this->renderPartial('printbill', array('model'=>$model,'items'=>$items, 'price'=>$price), true));
        
        # Outputs ready PDF
	    $pdf->Output('Factura_'.date("d/m/Y").'.pdf','D');
		
	}
	
	
	/**
	*	Add extra to Book
	*/
	public function actionAddExtra()
	{
		$bookID = $_POST["book"];
		$name = $_POST["extra"];
		$value = $_POST["value"];
		
		$model = new Extra;
		$model->BookID = $bookID;
		$model->Name = $name;
		$model->Value = $value;
		$model->UserID = Yii::app()->user->ID;
		
		if($model->save()):
			$criteria = new CDbCriteria();
			$criteria->condition = "UserID = :userid AND BookID = :bookid";
			$criteria->params = array(':userid' => Yii::app()->user->ID, ':bookid' => $model->BookID);
			
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
			
			echo '<script>
			function calculaPrecio(start,finish,room,pax)
			{
				var request = $.ajax({
	                url: "'.$this->createURL("book/calculateprice").'",
	                type: "POST",
	                data: {
	                    start : start,
	                    finish : finish,
	                    room : room,
	                    pax : pax,
	                    book : '.$model->BookID.'
	                },
	                dataType: "html"
	            });
	
	            request.done(function(msg) {
	            	$("#pvp").html(msg);
	            });
			}
			// Delete Extra from Book
			$(".deleteExtra").click(function(){
				
				if(confirm("\u00bfSeguro que quieres eliminar este suplemento?"))
				{
					var request = $.ajax({
			                url: "'.$this->createURL("book/deleteExtra").'",
			                type: "POST",
			                dataType: "html",
							data: {
								extra : $(this).attr("id"),
								book : '.$model->BookID.'
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
			                url: "'.$this->createURL("book/deleteDiscount").'",
			                type: "POST",
			                dataType: "html",
							data: {
								discount : $(this).attr("id"),
								book : '.$model->BookID.'
							}
			        });
			
			        request.done(function(msg) {
			        		$("#extraDiscount").html(msg);
			        		calculaPrecio($("#Book_Start").val(), $("#Book_Finish").val(), $("#Book_RoomID").val(), $("#Book_Pax").val());
			        });
			    }
	
			});
			</script>';
			
		else:
			var_dump($model->errors);	
		endif;
			
	}
	
	
	/**
	*	Add discount to Book
	*/
	public function actionAddDiscount()
	{
		$bookID = $_POST["book"];
		$name = $_POST["discount"];
		$value = $_POST["value"];
		
		$model = new Discount;
		$model->BookID = $bookID;
		$model->Name = $name;
		$model->Value = $value;
		$model->UserID = Yii::app()->user->ID;
		
		if($model->save()):
			$criteria = new CDbCriteria();
			$criteria->condition = "UserID = :userid AND BookID = :bookid";
			$criteria->params = array(':userid' => Yii::app()->user->ID, ':bookid' => $model->BookID);
			
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
			
			echo '<script>
			function calculaPrecio(start,finish,room,pax)
			{
				var request = $.ajax({
	                url: "'.$this->createURL("book/calculateprice").'",
	                type: "POST",
	                data: {
	                    start : start,
	                    finish : finish,
	                    room : room,
	                    pax : pax,
	                    book : '.$model->BookID.'
	                },
	                dataType: "html"
	            });
	
	            request.done(function(msg) {
	            	$("#pvp").html(msg);
	            });
			}
			// Delete Extra from Book
			$(".deleteExtra").click(function(){
				
				if(confirm("\u00bfSeguro que quieres eliminar este suplemento?"))
				{
					var request = $.ajax({
			                url: "'.$this->createURL("book/deleteExtra").'",
			                type: "POST",
			                dataType: "html",
							data: {
								extra : $(this).attr("id"),
								book : '.$model->BookID.'
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
			                url: "'.$this->createURL("book/deleteDiscount").'",
			                type: "POST",
			                dataType: "html",
							data: {
								discount : $(this).attr("id"),
								book : '.$model->BookID.'
							}
			        });
			
			        request.done(function(msg) {
			        		$("#extraDiscount").html(msg);
			        		calculaPrecio($("#Book_Start").val(), $("#Book_Finish").val(), $("#Book_RoomID").val(), $("#Book_Pax").val());
			        });
			    }
	
			});
			</script>';
		else:
			var_dump($model->errors);	
		endif;
			
	}
	
	/**
	*	Delete discount from Book
	*/
	public function actionDeleteDiscount()
	{
		$model = Discount::model()->findByPK($_POST["discount"]);
		$model->delete();
		
		$criteria = new CDbCriteria();
		$criteria->condition = "UserID = :userid AND BookID = :bookid";
		$criteria->params = array(':userid' => Yii::app()->user->ID, ':bookid' => $_POST["book"]);
		
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
		
		echo '
		<script>
		function calculaPrecio(start,finish,room,pax)
			{
				var request = $.ajax({
	                url: "'.$this->createURL("book/calculateprice").'",
	                type: "POST",
	                data: {
	                    start : start,
	                    finish : finish,
	                    room : room,
	                    pax : pax,
	                    book : '.$_POST["book"].'
	                },
	                dataType: "html"
	            });
	
	            request.done(function(msg) {
	            	$("#pvp").html(msg);
	            });
			}
		// Delete Extra from Book
		$(".deleteExtra").click(function(){
			
			if(confirm("\u00bfSeguro que quieres eliminar este suplemento?"))
			{
				var request = $.ajax({
		                url: "'.$this->createURL("book/deleteExtra").'",
		                type: "POST",
		                dataType: "html",
						data: {
							extra : $(this).attr("id"),
							book : '.$_POST["book"].'
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
		                url: "'.$this->createURL("book/deleteDiscount").'",
		                type: "POST",
		                dataType: "html",
						data: {
							discount : $(this).attr("id"),
							book : '.$_POST["book"].'
						}
		        });
		
		        request.done(function(msg) {
		        		$("#extraDiscount").html(msg);
		        		calculaPrecio($("#Book_Start").val(), $("#Book_Finish").val(), $("#Book_RoomID").val(), $("#Book_Pax").val());
		        });
		    }

		});
		</script>
		';
	}
	
	/**
	*	Delete extra from Book
	*/
	public function actionDeleteExtra()
	{
		$model = Extra::model()->findByPK($_POST["extra"]);
		$model->delete();
		
		$criteria = new CDbCriteria();
		$criteria->condition = "UserID = :userid AND BookID = :bookid";
		$criteria->params = array(':userid' => Yii::app()->user->ID, ':bookid' => $_POST["book"]);
		
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
		
		echo '
		<script>
		function calculaPrecio(start,finish,room,pax)
			{
				var request = $.ajax({
	                url: "'.$this->createURL("book/calculateprice").'",
	                type: "POST",
	                data: {
	                    start : start,
	                    finish : finish,
	                    room : room,
	                    pax : pax,
	                    book : '.$_POST["book"].'
	                },
	                dataType: "html"
	            });
	
	            request.done(function(msg) {
	            	$("#pvp").html(msg);
	            });
			}
		// Delete Extra from Book
		$(".deleteExtra").click(function(){
			
			if(confirm("\u00bfSeguro que quieres eliminar este suplemento?"))
			{
				var request = $.ajax({
		                url: "'.$this->createURL("book/deleteExtra").'",
		                type: "POST",
		                dataType: "html",
						data: {
							extra : $(this).attr("id"),
							book : '.$_POST["book"].'
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
		                url: "'.$this->createURL("book/deleteDiscount").'",
		                type: "POST",
		                dataType: "html",
						data: {
							discount : $(this).attr("id"),
							book : '.$_POST["book"].'
						}
		        });
		
		        request.done(function(msg) {
		        		$("#extraDiscount").html(msg);
		        		calculaPrecio($("#Book_Start").val(), $("#Book_Finish").val(), $("#Book_RoomID").val(), $("#Book_Pax").val());
		        });
		    }

		});
		</script>
		';
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Book::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	
	public function actionFillCustomer()
	{
		$model = Customer::model()->findByPK($_POST["id"]);
		
		echo CJSON::encode($model);
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='book-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
