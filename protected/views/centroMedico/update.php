<?php
/* @var $this CentroMedicoController */
/* @var $model CentroMedico */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/admin/actionCentroMedico.js');

$this->breadcrumbs=array(
	'Centro Medicos'=>array('index'),
	$model->nombre=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
	array('label'=>'Ingresar nuevo', 'url'=>array('create')),
	array('label'=>'Detalle', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar', 'url'=>array('admin')),
    array('label'=>'Eliminar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Estás seguro que deseas eliminar este elemento?')),
);
?>

<h2 class="white">Editar <small><?php echo $model->nombre;?></small></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); 
echo "<script>actionCentroMedico.cargarMapaEdicion(".$model->x.",".$model->y.");</script>";
?>