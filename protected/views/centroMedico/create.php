<?php
/* @var $this CentroMedicoController */
/* @var $model CentroMedico */

$this->breadcrumbs=array(
	'Centro Medicos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CentroMedico', 'url'=>array('index')),
	array('label'=>'Manage CentroMedico', 'url'=>array('admin')),
);
?>

<h1>Create CentroMedico</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>