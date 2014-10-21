<?php
/* @var $this CentroMedicoController */
/* @var $model CentroMedico */

$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/admin/actionCentroMedico.js');

$this->breadcrumbs=array(
	'Centro Medicos'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar', 'url'=>array('index')),
	array('label'=>'Administrar', 'url'=>array('admin')),
);
?>

<h1>Crear Centro Médico</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); 
echo "<script>actionCentroMedico.cargarMapaIngreso('CentroMedico');</script>";?>