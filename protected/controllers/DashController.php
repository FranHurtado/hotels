<?php

/**
 * @author Serg.Kosiy <serg.kosiy@gmail.com>
 */
class DashController extends UIDashboardController
{
    // uncomment the following to apply new layout for the controller view.
    //public $layout = '//layouts/column2';

    public function init()
    {
        parent::init();

        // Create new field in your users table for store dashboard preference
        // Set table name, user ID field name, user preference field name
        $this->setTableParams('dashboard_page', 'user_id', 'title');
        
        // set array of portlets
        $this->setPortlets(
                array(
                    array('id' => 1, 'title' => 'Clientes', 'content' => 'Contenido...<br /><br /><br /><br /><br /><br />'),
                    array('id' => 2, 'title' => 'Reservas', 'content' => 'Contenido...<br /><br /><br /><br /><br /><br />'),
                    array('id' => 3, 'title' => 'Puntos cr&iacute;ticos', 'content' => 'Contenido...<br /><br /><br /><br /><br /><br />'),
                    array('id' => 4, 'title' => 'Marketing', 'content' => 'Contenido...<br /><br /><br /><br /><br /><br />'),
                    array('id' => 5, 'title' => 'Informes', 'content' => 'Contenido...<br /><br /><br /><br /><br /><br />'),
                    array('id' => 6, 'title' => 'Facturas', 'content' => 'Contenido...<br /><br /><br /><br /><br /><br />'),
                    //array('id' => 6, 'title' => 'Reference', 'content' => $this->renderPartial('viewName', null, true)),
                )
        );

        //set content BEFORE dashboard
        $this->setContentBefore(
                //Pay attension: ExtController looking view in current dir!!!
                //$this->renderPartial('/../views/dash/before', null, true)
                );

        // uncomment the following to apply jQuery UI theme
        // from protected/components/assets/themes folder
        $this->applyTheme('ui-lightness');

        // uncomment the following to change columns count
        //$this->setColumns(4);

        // uncomment the following to enable autosave
        $this->setAutosave(true);

        // uncomment the following to disable dashboard header
        //$this->setShowHeaders(false);

        // uncomment the following to enable context menu and add needed items
        /*
        $this->menu = array(
            array('label' => 'Index', 'url' => array('index')),
        );
        */
    }
    
    /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
				'actions'=>array('dash'),
				'users'=>array('@'),
                'expression'=>$User,
			),
            
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('dash'),
				'users'=>array('@'),
                'expression'=>$Admin,
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
    public function actionIndex()
    {
	    
    }

}
