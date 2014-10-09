<?php
/* @var $this CentroMedicoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Centro Medicos',
);

$this->menu=array(
	array('label'=>'Create CentroMedico', 'url'=>array('create')),
	array('label'=>'Manage CentroMedico', 'url'=>array('admin')),
);
?>

<h1>Centro Medicos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
