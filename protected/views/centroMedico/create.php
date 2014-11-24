<?php
/* @var $this CentroMedicoController */
/* @var $model CentroMedico */

$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/admin/actionCentroMedico.js');

$this->breadcrumbs=array(
	'Centro Medicos'=>array('admin'),
	'Nuevo Centro Médico',
);

$this->menu=array(
	//array('label'=>'Listar', 'url'=>array('index')),
	array('label'=>'Ver Todos', 'url'=>array('admin')),
);
?>

<h2 class="white">Agregar Centro Médico</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); 
echo "<script>actionCentroMedico.cargarMapaIngreso('CentroMedico');</script>";?>