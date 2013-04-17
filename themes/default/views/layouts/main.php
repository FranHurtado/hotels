<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	
	<?php Yii::app()->clientScript->registerScriptFile('http://malsup.github.com/jquery.form.js', CClientScript::POS_HEAD); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
		
		<?php if(!Yii::app()->user->isGuest): ?>
			<div id="notifications"></div>
		<?php endif; ?>
		<div class="br"></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php if(!Yii::app()->user->isGuest): ?>
			<div id="searchdiv">
				<input type="text" name="search" id="search" />
			</div>
		<?php endif; ?>
		
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array(
					'label'=>'Inicio', 
					'url'=>array('/dash'), 
					'visible'=>!Yii::app()->user->isGuest,
					'active'=>$this->id=='dash'
				),
				array(
					'label'=>'Mis datos', 
					'url'=>array('/user/user/update/',"id"=>Yii::app()->user->ID), 
					'visible'=>!Yii::app()->user->isGuest,
					'active'=>$this->module->id=='user' && $this->action->id=='update'
				),
				array(
					'label'=>'Clientes', 
					'url'=>array('/customer/customer/admin'), 
					'visible'=>!Yii::app()->user->isGuest,
					'active'=>$this->module->id=='customer'
				),
				array(
					'label'=>'Reservas', 
					'url'=>array('/booking/book/planning'), 
					'visible'=>!Yii::app()->user->isGuest,
					'active'=>$this->module->id=='booking'
				),
				array(
					'label'=>'APPC', 
					'url'=>array('/APPC/point/admin'), 
					'visible'=>!Yii::app()->user->isGuest,
					'active'=>$this->module->id=='APPC'
				),
				array(
					'label'=>'Marketing', 
					'url'=>array('/mail/mail/admin'), 
					'visible'=>!Yii::app()->user->isGuest,
					'active'=>$this->module->id=='mail'
				),				
				array(
					'label'=>'Facturas', 
					'url'=>array('/invoice/invoice/admin'), 
					'visible'=>!Yii::app()->user->isGuest,
					'active'=>$this->module->id=='invoice'
				),
				array(
					'label'=>'Codigo Web', 
					'url'=>array('/user/user/code/'), 
					'visible'=>!Yii::app()->user->isGuest,
					'active'=>$this->action->id=='code'
				),
				array(
					'label'=>'Desconectar ('.Yii::app()->user->name.')', 
					'url'=>array('/site/logout'), 
					'visible'=>!Yii::app()->user->isGuest,
					'itemOptions'=>array('class'=>'last')
				)
			),
		)); ?>
		<div class="br"></div>
	</div><!-- mainmenu -->

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		<?php echo date('Y'); ?> Oasis CRM<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
