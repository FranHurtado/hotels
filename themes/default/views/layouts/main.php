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

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
		
		<?php if(!Yii::app()->user->isGuest): ?>
			<div id="notifications">Notificaciones</div>
		<?php endif; ?>
		<div class="br"></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php if(!Yii::app()->user->isGuest): ?>
			<div id="searchdiv">
				<input type="text" name="search" id="search" />
			</div>
		<?php endif; ?>
		
		<?php $this->widget('ext.emenu.EMenu',array(
			'themeCssFile' => '',
			'items'=>array(
				array('label'=>'Inicio', 'url'=>array('/dash'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Clientes', 'url'=>array('/customer/customer/admin'), 'visible'=>!Yii::app()->user->isGuest,),
				array('label'=>'Reservas', 'url'=>'', 'visible'=>!Yii::app()->user->isGuest,
					'items'=>array(
						array('label'=>'Clientes', 'url'=>array(''), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Habitaciones', 'url'=>array(''), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Temporadas', 'url'=>array(''), 'visible'=>!Yii::app()->user->isGuest),
					),
				),
				array('label'=>'APPC', 'url'=>array('/APPC/control/admin'), 'visible'=>!Yii::app()->user->isGuest,
					'items'=>array(
						array('label'=>'Puntos criticos', 'url'=>array('/APPC/point/admin'), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Trabajadores', 'url'=>array('/APPC/worker/admin'), 'visible'=>!Yii::app()->user->isGuest),
					),
				),
				array('label'=>'Marketing', 'url'=>array('/mail/mail/admin'), 'visible'=>!Yii::app()->user->isGuest,
					'items'=>array(
						array('label'=>'Listas de envio', 'url'=>array('/mail/mailist/admin'), 'visible'=>!Yii::app()->user->isGuest),
					),
				),
				array('label'=>'Informes', 'url'=>'', 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Facturas', 'url'=>'', 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
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
