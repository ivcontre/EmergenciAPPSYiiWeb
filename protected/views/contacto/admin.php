<?php
/* @var $this ContactoController */
/* @var $model Contacto */

$this->breadcrumbs=array(
	'Perfil'=>array('usuario/view&id='.Yii::app()->user->id),
	'Contactos',
);

$this->menu=array(
	array('label'=>'Agregar Nuevo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#contacto-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Contactos</h1>



<?php echo CHtml::link('Búsqueda advanzada','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'contacto-grid',
	'dataProvider'=>$model->search(),
        'emptyText'=>'No has agregado contactos todavía :(',
	'filter'=>$model,
	'columns'=>array(
		//'id_contacto',
		//'numero_telefono',
		'nombre',
		'numero',
		'correo',
		//'estado',
		'alerta_sms',
		'alerta_gps',
		'alerta_correo',
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>