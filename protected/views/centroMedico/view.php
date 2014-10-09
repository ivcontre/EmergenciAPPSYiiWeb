
 
<?php
/* @var $this CentroMedicoController */
/* @var $model CentroMedico */

$this->breadcrumbs=array(
	'Centro Medicos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CentroMedico', 'url'=>array('index')),
	array('label'=>'Create CentroMedico', 'url'=>array('create')),
	array('label'=>'Update CentroMedico', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CentroMedico', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CentroMedico', 'url'=>array('admin')),
);
?>

<h1>Detalle Centro Médico ID: <?php echo $model->id; ?></h1>

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
 echo "<script>initializeconcoordenadas(".$model->x.",".$model->y.");</script>";
?>



