<?php
/* @var $this PdiController */
/* @var $model PDI */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/actionPDI.js');

$this->breadcrumbs=array(
	'Pdis'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PDI', 'url'=>array('index')),
	array('label'=>'Create PDI', 'url'=>array('create')),
	array('label'=>'View PDI', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PDI', 'url'=>array('admin')),
);
?>

<h1>Update PDI <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); 
echo "<script>actionPDI.cargarMapaEdicion(".$model->x.",".$model->y.");</script>";
?>