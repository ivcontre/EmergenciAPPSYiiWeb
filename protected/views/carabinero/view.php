<?php
/* @var $this CarabineroController */
/* @var $model Carabinero */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/actionCarabinero.js');
$this->breadcrumbs=array(
	'Carabineros'=>array('index'),
	$model->nombre,
);

$this->menu=array(
	array('label'=>'Ingresar nuevo', 'url'=>array('create')),
	array('label'=>'Editar', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar', 'url'=>array('admin')),
);
?>

<?php echo TbHtml::pageHeader('Detalle Carabinero', $model->nombre); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'direccion',
		'idComuna.nombre',
                'x',
		'y',
		'telefono',
	),
)); 
?>
<div id="map_detalle" style="width: 100%; height:350px"></div>
<?php
 echo "<script>actionCarabinero.initializeconcoordenadas(".$model->x.",".$model->y.");</script>";
?>
