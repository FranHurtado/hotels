<?php

class CustomerController extends Controller
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
				'actions'=>array('create','update','delete','admin','print'),
				'users'=>array('@'),
                'expression'=>$User,
			),
            
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete','admin','print'),
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
		$model=new Customer;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Customer']))
		{
			$model->attributes=$_POST['Customer'];
			if($model->save()):
				// Comprobamos si existe la lista de envio de todos los clientes
				if(count(Mailist::model()->findByAttributes(array('Name'=>'Todos los clientes','UserID'=>Yii::app()->user->ID)))):
					// Si existe la lista añadimos el nuevo cliente
					$ListID = Mailist::model()->findByAttributes(array('Name'=>'Todos los clientes'))->ID;
					$modelCustomerList = new CustomerList;
					$modelCustomerList->UserID = Yii::app()->user->ID;
					$modelCustomerList->ListID = $ListID;
					$modelCustomerList->CustomerID = $model->ID;
					$modelCustomerList->save();
				else:
					// Si no existe la lista la creamos y añadimos el cliente nuevo
					$modelMailist = new Mailist;
					$modelMailist->Name = "Todos los clientes";
					$modelMailist->UserID = Yii::app()->user->ID;
					if($modelMailist->save()):
						$modelCustomerList = new CustomerList;
						$modelCustomerList->UserID = Yii::app()->user->ID;
						$modelCustomerList->ListID = $modelMailist->ID;
						$modelCustomerList->CustomerID = $model->ID;
						$modelCustomerList->save();
					endif;
				endif;
					
				$this->redirect(array('admin'));
			endif;
		}

		$this->render('create',array(
			'model'=>$model,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Customer']))
		{
			$model->attributes=$_POST['Customer'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
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
		$dataProvider=new CActiveDataProvider('Customer');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Customer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Customer']))
			$model->attributes=$_GET['Customer'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Print all customer in PDF
	 */
	public function actionPrint()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "UserID = :userid";
		$criteria->params = array(':userid' => Yii::app()->user->ID);
		$criteria->order = 'FullName';
		$model = Customer::model()->findAll($criteria);
		
		// Print customers
		set_time_limit(600);
    		
        # mPDF
        $pdf = Yii::app()->ePdf->mpdf('', 'A4', '','','','','','','','','P');

        $pdf->writeHTMLfooter=false;
        $pdf->writeHTMLheader=false;
        $pdf->DeflMargin=15;
        $pdf->DefrMargin=15;
        $pdf->tMargin=15;
        $pdf->bMargin=15;

        $pdf->w=297;   //manually set width
        $pdf->h=209.8; //manually set height
        
        $pdf->WriteHTML($this->renderPartial('_print', array('model'=>$model), true));
        
        # Outputs ready PDF
	    $pdf->Output('Factura_'.date("d/m/Y").'.pdf','D');
	}
	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Customer::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='customer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
