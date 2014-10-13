<?php
/* @var $this CarabineroController */
/* @var $model Carabinero */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/actionCarabinero.js');

$this->breadcrumbs=array(
	'Carabineros'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Carabinero', 'url'=>array('index')),
	array('label'=>'Manage Carabinero', 'url'=>array('admin')),
);
?>
<h1>Crear Carabinero</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>