<!-- blueprint CSS framework -->
<!--link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/protected/extensions/bootstrap/assets/css/bootstrap.css" /-->

<style>
body {
margin: 0;
font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
font-size: 14px;
line-height: 20px;
color: #333333;
background-color: #ffffff;
}
.container {
margin-right: auto;
margin-left: auto;
}
.container, .navbar-static-top .container, .navbar-fixed-top .container, .navbar-fixed-bottom .container {
width: 940px;
}

h1 {
font-size: 38.5px;
}
h1, h2, h3 {
line-height: 40px;
}
h1, h2, h3, h4, h5, h6 {
margin: 10px 0;
font-family: inherit;
font-weight: bold;
line-height: 20px;
color: inherit;
text-rendering: optimizelegibility;
}

h1 small {
font-size: 24.5px;
}
h1 small, h2 small, h3 small, h4 small, h5 small, h6 small {
font-weight: normal;
line-height: 1;
color: #999999;
}
small {
font-size: 85%;
}
.table {
width: 100%;
margin-bottom: 20px;
}
table {
max-width: 100%;
background-color: transparent;
border-collapse: collapse;
border-spacing: 0;
}
user agent stylesheettable {
white-space: normal;
line-height: normal;
font-weight: normal;
font-size: medium;
font-variant: normal;
font-style: normal;
color: -webkit-text;
text-align: start;
}

thead {
display: table-header-group;
vertical-align: middle;
border-color: inherit;
}

.table caption + thead tr:first-child th, .table caption + thead tr:first-child td, .table colgroup + thead tr:first-child th, .table colgroup + thead tr:first-child td, .table thead:first-child tr:first-child th, .table thead:first-child tr:first-child td {
border-top: 0;
}
.table thead th {
vertical-align: bottom;
}
.table th {
font-weight: bold;
}
.table th, .table td {
padding: 8px;
line-height: 20px;
text-align: left;
vertical-align: top;
border-top: 1px solid #dddddd;
}


</style>
<?php Yii::app()->bootstrap->register(); ?>
        <div class="container">
            <h1><small>Centros médicos</small></h1>
<?php
/* @var $model CentroMedico */
/* @var $criteria Criteria */

    $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => TbHtml::GRID_TYPE_HOVER,
    'dataProvider'=>new CActiveDataProvider($model, array(
                                                    'criteria'=>$criteria,
                                                    'pagination'=>false,)),
    'template' => "{items}",
    'columns'=>array(
		array(
                    'value' => '$data->id',
                    'name' => 'ID'
                ),
                array(
                    'value' => '$data->nombre',
                    'name' => 'Nombre'
                ),
                array(
                    'value' => '$data->direccion',
                    'name' => 'Dirección'
                ),
		array(
                    'value' => '$data->idComuna->nombre',
                    'name' => 'Comuna'
                ),
		array(
                    'value' => '$data->telefono',
                    'name' => 'Teléfono'
                ),
	),
    ));
?>
</div>
