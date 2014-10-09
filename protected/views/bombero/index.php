<?php
/* @var $this BomberoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bomberos',
);

$this->menu=array(
	array('label'=>'Create Bombero', 'url'=>array('create')),
	array('label'=>'Manage Bombero', 'url'=>array('admin')),
);
?>

<h1>Bomberos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
