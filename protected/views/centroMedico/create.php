<?php
/* @var $this CentroMedicoController */
/* @var $model CentroMedico */

$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/actionCentroMedico.js');

$this->breadcrumbs=array(
	'Centro Medicos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Centros Médicos', 'url'=>array('index')),
	array('label'=>'Administrar Centros Médicos', 'url'=>array('admin')),
);
?>

<h1>Create CentroMedico</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); 
echo "<script>actionCentroMedico.cargarMapaIngreso('CentroMedico');</script>";?>