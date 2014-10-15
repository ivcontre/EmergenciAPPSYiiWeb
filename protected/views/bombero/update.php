<?php
/* @var $this BomberoController */
/* @var $model Bombero */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/actionBombero.js');

$this->breadcrumbs=array(
	'Bomberos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bombero', 'url'=>array('index')),
	array('label'=>'Create Bombero', 'url'=>array('create')),
	array('label'=>'View Bombero', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Bombero', 'url'=>array('admin')),
);
?>

<h1>Update Bombero <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>