<?php
/* @var $this ComunaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Comunas',
);

$this->menu=array(
	array('label'=>'Create Comuna', 'url'=>array('create')),
	array('label'=>'Manage Comuna', 'url'=>array('admin')),
);
?>

<h1>Comunas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
