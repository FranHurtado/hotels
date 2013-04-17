<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div id="content">
	<div class="span-5 last">
		<div id="sidebar">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				/* Sistema que busca lka traduccion del nombre del controlador
					para mostrarlo en la cabecera del menu */
				'title'=>'Opciones - ' . Yii::t("Menus", $this->id),
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		?>
		</div><!-- sidebar -->
		<div id="sidebar">
		<?php 
			if($this->help != ''): 
				$this->beginWidget('zii.widgets.CPortlet', array(
					/* Sistema que busca lka traduccion del nombre del controlador
						para mostrarlo en la cabecera del menu */
					'title'=>'Ayuda - ' . Yii::t("Menus", $this->id),
				));
				
				echo "<p style='padding-top: 10px;'>" . $this->help . "</p>";

				$this->endWidget();
			endif;	
		?>
		</div><!-- sidebar -->
	</div>
	
	<div class="span-19">
			<?php echo $content; ?>
	</div>
	
	<div style="clear:both;"></div>
</div><!-- content -->
<?php $this->endContent(); ?>