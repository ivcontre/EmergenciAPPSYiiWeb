<?php
/* @var $this PdiController */
/* @var $model PDI */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/admin/actionPDI.js');

$this->breadcrumbs=array(
	'Pdis'=>array('admin'),
	'Nuevo',
);

$this->menu=array(
	//array('label'=>'Listar', 'url'=>array('index')),
	array('label'=>'Ver Todos', 'url'=>array('admin')),
);
?>

<h2 class="white">Agregar Oficina de PDI</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); 
echo "<script>actionPDI.cargarMapaIngreso('PDI');</script>";?>