<?php
/* @var $this CarabineroController */
/* @var $model Carabinero */

$this->breadcrumbs=array(
	'Carabineros'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Carabineros', 'url'=>array('index')),
	array('label'=>'Crear Carabinero', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#carabinero-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Carabineros</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php // $this->widget('zii.widgets.grid.CGridView', array(
//	'id'=>'carabinero-grid',
//	'dataProvider'=>$model->search(),
//	'filter'=>$model,
//	'columns'=>array(
//		'id',
//		'nombre',
//		'direccion',
//		array(
//                    'value' => '$data->idComuna->nombre',
//                    'name' => 'id_comuna'
//                ),
//		
//		'x',
//		
//		'y',
//		'telefono',
//		array(
//			'class'=>'CButtonColumn',
//		),
//	),
//)); 
$this->widget('bootstrap.widgets.TbGridView', array(
   'dataProvider' => $model->search(),
   'filter' => $model,
   'type' => TbHtml::GRID_TYPE_HOVER,
   'template' => "{items}",
   'columns'=>array(
		'id',
		'nombre',
		'direccion',
		array(
                    'value' => '$data->idComuna->nombre',
                    'name' => 'id_comuna'
                ),
		
		'x',
		
		'y',
		'telefono',
		array(
			'class'=>'CButtonColumn',
		),
	),
));

?>
