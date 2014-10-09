<?php
/* @var $this CentroMedicoController */
/* @var $model CentroMedico */

$this->breadcrumbs=array(
	'Centro Medicos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CentroMedico', 'url'=>array('index')),
	array('label'=>'Create CentroMedico', 'url'=>array('create')),
	array('label'=>'View CentroMedico', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CentroMedico', 'url'=>array('admin')),
);
?>

<h1>Update CentroMedico <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>