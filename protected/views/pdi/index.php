<?php
/* @var $this PdiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pdis',
);

$this->menu=array(
	array('label'=>'Create PDI', 'url'=>array('create')),
	array('label'=>'Manage PDI', 'url'=>array('admin')),
);
?>

<h1>Pdis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
