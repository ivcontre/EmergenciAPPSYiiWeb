<?php
/* @var $this ComunaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Comunas',
);

$this->menu=array(
	array('label'=>'Ingresar Nuevo', 'url'=>array('create')),
	array('label'=>'Administrar', 'url'=>array('admin')),
);
?>

<h1>Comunas</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
        'type' => TbHtml::GRID_TYPE_HOVER,
        'dataProvider'=>$dataProvider,
        'columns'=>array(
		'id_comuna',
		'nombre',
		array(
			'class'=>'CButtonColumn',
                        'deleteButtonImageUrl'=>false,
                        'updateButtonImageUrl'=>false,
                        'viewButtonImageUrl'=>false,
                        'template'=>'{view}',
                        'buttons' => array(
                            'view'=>array(
                                    
                                    'url'=>'Yii::app()->createUrl("comuna/view", array("id"=>$data->id_comuna))',
                                    'label'=>' ',
                                    'options'=>array(
                                        'class'=>TbHtml::ICON_SEARCH
                                    ), // HTML options for the button tag
                               
                            ),
                            ),
		),
	),
    ));
?>
