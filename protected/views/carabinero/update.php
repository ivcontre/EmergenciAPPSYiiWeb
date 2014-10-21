<?php
/* @var $this CarabineroController */
/* @var $model Carabinero */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/admin/actionCarabinero.js');

$this->breadcrumbs=array(
	'Carabineros'=>array('index'),
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

<?php echo TbHtml::pageHeader('Editar', $model->nombre); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); 
    echo "<script>actionCarabinero.cargarMapaEdicion(".$model->x.",".$model->y.");</script>";
?>
