<?php
/* @var $this CentroMedicoController */
/* @var $model CentroMedico */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/actionCentroMedico.js');

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

<?php $this->renderPartial('_form', array('model'=>$model)); 
echo "<script>actionCentroMedico.cargarMapaEdicion(".$model->x.",".$model->y.");</script>";
?>