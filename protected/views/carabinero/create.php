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
	'Carabineros'=>array('admin'),
	'Nuevo',
);

$this->menu=array(
	//array('label'=>'Listar', 'url'=>array('index')),
	array('label'=>'Ver Todos', 'url'=>array('admin')),
);
?>
<h2 class="white">Agregar Retén de Carabineros</h2>

<?php 
$this->renderPartial('_form', array('model'=>$model)); 
echo "<script>actionCarabinero.cargarMapaIngreso('Carabinero');</script>";
?>
