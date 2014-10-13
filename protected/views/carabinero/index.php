<?php
/* @var $this CarabineroController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Carabineros',
);

$this->menu=array(
	array('label'=>'Crear Carabinero', 'url'=>array('create')),
	array('label'=>'Administrar Carabinero', 'url'=>array('admin')),
);

//$this->widget('bootstrap.widgets.TbNav', array(
//    'type' => TbHtml::NAV_TYPE_LIST,
//    'items' => array(
//        array('label' => 'Operaciones'),
//        array('label' => 'Crear Carabinero', 'url' => array('create')),
//        array('label' => 'Administrar Carabineros', 'url' => array('create')),
//
//    )
//));
?>

<h1>Carabineros</h1>

<?php 
//$this->widget('zii.widgets.CListView', array(
//	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
//)); 
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => TbHtml::GRID_TYPE_HOVER,
        'dataProvider'=>$dataProvider,
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
                        'deleteButtonImageUrl'=>false,
                        'updateButtonImageUrl'=>false,
                        'viewButtonImageUrl'=>false,
                        'template'=>'{view}',
                        'buttons' => array(
                            'view'=>array(
                                    
                                    'url'=>'Yii::app()->createUrl("carabinero/view", array("id"=>$data->id))',
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
