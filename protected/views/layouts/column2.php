<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="span3 last">
	<div id="sidebar">
	<?php
        array_unshift($this->menu, array('label'=>'Operaciones'));
		$this->widget('bootstrap.widgets.TbNav', array(
                        'type' => TbHtml::NAV_TYPE_LIST,
			'items'=>$this->menu,
                        'htmlOptions' => array('class' => 'well'),
			
		));
	?>
	</div><!-- sidebar -->
</div>
<div class="span8">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>