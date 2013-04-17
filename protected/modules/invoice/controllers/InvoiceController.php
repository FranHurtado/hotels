<?php

class InvoiceController extends Controller
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
				'actions'=>array('create','update','delete','admin','fillcustomer','print','addcharge','deletecharge'),
				'users'=>array('@'),
                'expression'=>$User,
			),
            
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete','admin','fillcustomer','print','addcharge','deletecharge'),
				'users'=>array('@'),
                'expression'=>$Admin,
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
		$model=new Invoice;
		$modelCustomer=new Customer;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Invoice']))
		{
			$model->attributes=$_POST['Invoice'];

			// Si creamos un nuevo Customer hay que guardarlo
			if(strlen($model->CustomerID) == 0):
				$modelCustomer->attributes=$_POST['Customer'];
				if($modelCustomer->save()):
					$model->CustomerID = $modelCustomer->ID;
				endif;
			else:
				$modelCustomer = Customer::model()->findByPK($model->CustomerID);
				$modelCustomer->attributes=$_POST['Customer'];
				$modelCustomer->save();
			endif;
			
			if($model->save())
				$this->redirect(array('admin'));
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

		if(isset($_POST['Invoice']))
		{
			$model->attributes=$_POST['Invoice'];
			
			// Si creamos un nuevo Customer hay que guardarlo
			if(strlen($model->CustomerID) == 0) :
				$modelCustomer->attributes=$_POST['Customer'];
				if($modelCustomer->save()):
					$model->CustomerID = $modelCustomer->ID;
				endif;
			else :
				$modelCustomer = Customer::model()->findByPK($model->CustomerID);
				$modelCustomer->attributes=$_POST['Customer'];
				$modelCustomer->save();
			endif;
			
			if($model->save())
				$this->redirect(array('admin'));
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
		$dataProvider=new CActiveDataProvider('Invoice');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Invoice('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Invoice']))
			$model->attributes=$_GET['Invoice'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionFillCustomer()
	{
		$model = Customer::model()->findByPK($_POST["id"]);
		
		echo CJSON::encode($model);
	}
	
	/*
	 * Print invoice
	 */
	public function actionPrint($id)
	{
		$model = $this->loadModel($id);
		
		$criteria = new CDbCriteria();
		$criteria->condition = "UserID = :userid AND InvoiceID = :invoiceid";
		$criteria->params = array(':userid' => Yii::app()->user->ID, ':invoiceid' => $model->ID);
		$modelCharges = Charge::model()->findAll($criteria);
		
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
        
        $pdf->WriteHTML($this->renderPartial('_print', array('model'=>$model,'modelCharges'=>$modelCharges), true));
        
        # Outputs ready PDF
	    $pdf->Output('Factura_'.date("d/m/Y").'.pdf','D');
	}
	
	/**
	*	Add charge to Invoice
	*/
	public function actionAddCharge()
	{
		$invoiceID = $_POST["invoice"];
		$name = $_POST["charge"];
		$value = $_POST["value"];
		
		$model = new Charge;
		$model->InvoiceID = $invoiceID;
		$model->Text = $name;
		$model->Price = $value;
		$model->IVA = User::model()->findByPK(Yii::app()->user->ID)->IVA;
		$model->UserID = Yii::app()->user->ID;
		
		if($model->save()):
			$criteria = new CDbCriteria();
			$criteria->condition = "UserID = :userid AND InvoiceID = :invoiceid";
			$criteria->params = array(':userid' => Yii::app()->user->ID, ':invoiceid' => $invoiceID);
			
			$modelCharges = Charge::model()->findAll($criteria);
			
			foreach($modelCharges as $charge):
				echo "<p><span class='deleteCharge' id='". $charge->ID ."'>X</span>" . $charge->Text . " | " . str_replace('.',',',$charge->Price) . "&euro;</p>";
			endforeach;			
		else:
			var_dump($model->errors);	
		endif;
		
		echo '
		<script>
			$(".deleteCharge").click(function(){
			
				if(confirm("\u00bfSeguro que quieres eliminar este concepto?"))
				{
					var request = $.ajax({
			                url: "'.$this->createURL("invoice/deleteCharge").'",
			                type: "POST",
			                dataType: "html",
							data: {
								charge : $(this).attr("id"),
								invoice : '.$model->InvoiceID.'
							}
			        });
			
			        request.done(function(msg) {
			        		$("#concepts").html(msg);
			        });
			    }
			    
			});
		</script>
		';
			
	}
	
	/**
	*	Delete Charge from Invoice
	*/
	public function actionDeleteCharge()
	{
		$model = Charge::model()->findByPK($_POST["charge"]);
		$model->delete();
		
		$criteria = new CDbCriteria();
		$criteria->condition = "UserID = :userid AND InvoiceID = :invoiceid";
		$criteria->params = array(':userid' => Yii::app()->user->ID, ':invoiceid' => $_POST["invoice"]);
		
		$modelCharges = Charge::model()->findAll($criteria);
		
		foreach($modelCharges as $charge):
			echo "<p><span class='deleteCharge' id='". $charge->ID ."'>X</span>" . $charge->Text . " | " . str_replace('.',',',$charge->Price) . "&euro;</p>";
		endforeach;		
		
		echo '
		<script>
			$(".deleteCharge").click(function(){
			
				if(confirm("\u00bfSeguro que quieres eliminar este concepto?"))
				{
					var request = $.ajax({
			                url: "'.$this->createURL("invoice/deleteCharge").'",
			                type: "POST",
			                dataType: "html",
							data: {
								charge : $(this).attr("id"),
								invoice : '.$model->InvoiceID.'
							}
			        });
			
			        request.done(function(msg) {
			        		$("#concepts").html(msg);
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
		$model=Invoice::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='invoice-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
