<?php
/* @var $this CarabineroController */
/* @var $dataProvider CActiveDataProvider */

//$this->breadcrumbs=array(
//	'Carabineros',
//);
echo TbHtml::breadcrumbs(array(
    'Home' => 'http://parra.chillan.ubiobio.cl:8070/rhormaza/index.php',
    'Carabineros',
));

$this->menu=array(
        array('label'=>'Operaciones'),
	array('label'=>'Create Carabinero', 'url'=>array('create')),
	array('label'=>'Manage Carabinero', 'url'=>array('admin')),
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
    ));
    ?>
