<?php
/* @var $this PdiController */
/* @var $model PDI */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/admin/actionPDI.js');

$this->breadcrumbs=array(
	'Pdis'=>array('index'),
	$model->nombre=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar', 'url'=>array('index')),
	array('label'=>'Ingresar nuevo', 'url'=>array('create')),
	array('label'=>'Detalle', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar', 'url'=>array('admin')),
);
?>

<?php echo TbHtml::pageHeader('Editar ', $model->nombre); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); 
echo "<script>actionPDI.cargarMapaEdicion(".$model->x.",".$model->y.");</script>";
?>