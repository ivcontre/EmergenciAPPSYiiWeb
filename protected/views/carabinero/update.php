<?php
/* @var $this CarabineroController */
/* @var $model Carabinero */

$this->breadcrumbs=array(
	'Carabineros'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Carabinero', 'url'=>array('index')),
	array('label'=>'Create Carabinero', 'url'=>array('create')),
	array('label'=>'View Carabinero', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Carabinero', 'url'=>array('admin')),
);
?>

<h1>Update Carabinero <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>