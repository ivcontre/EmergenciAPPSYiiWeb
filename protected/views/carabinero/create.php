<?php
/* @var $this CarabineroController */
/* @var $model Carabinero */
/*
 *Inicializa actionCarabinero.js 
 */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/admin/actionCarabinero.js');

$this->breadcrumbs=array(
	'Carabineros'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar', 'url'=>array('index')),
	array('label'=>'Administrar', 'url'=>array('admin')),
);
?>
<h1>Crear Carabinero</h1>

<?php 
$this->renderPartial('_form', array('model'=>$model)); 
echo "<script>actionCarabinero.cargarMapaIngreso('Carabinero');</script>";
?>
