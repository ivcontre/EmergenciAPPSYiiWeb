<?php
/* @var $this CarabineroController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Carabineros',
);

$this->menu=array(
	array('label'=>'Create Carabinero', 'url'=>array('create')),
	array('label'=>'Manage Carabinero', 'url'=>array('admin')),
);
?>

<h1>Carabineros</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
