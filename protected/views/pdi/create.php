<?php
/* @var $this PdiController */
/* @var $model PDI */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/actionPDI.js');

$this->breadcrumbs=array(
	'Pdis'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PDI', 'url'=>array('index')),
	array('label'=>'Manage PDI', 'url'=>array('admin')),
);
?>

<h1>Create PDI</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); 
echo "<script>actionPDI.cargarMapaIngreso('PDI');</script>";?>