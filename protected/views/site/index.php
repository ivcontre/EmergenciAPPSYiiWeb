<?php
/* @var $this SiteController */

//$this->pageTitle=Yii::app()->name;
if(Yii::app()->user->isGuest){
    $carousel =  TbHtml::carousel(array(
        array('image' => 'holder.js/830x477', 'label' => 'First Thumbnail label', 'caption' => '...'),
        array('image' => 'holder.js/830x477', 'label' => 'Second Thumbnail label', 'caption' => '...'),
        array('image' => 'holder.js/830x477', 'label' => 'Third Thumbnail label', 'caption' => '...'),
    ));
    $this->widget('bootstrap.widgets.TbHeroUnit', array(
        'heading' => 'Bienvenido a '.CHtml::encode(Yii::app()->name),
        'content' => $carousel.'<p>Regístrate en nuestra página, descarga nuestra aplicación y sientete seguro en todo momento.</p>' . TbHtml::button('Descargar', array('color' =>TbHtml::BUTTON_COLOR_PRIMARY, 'size' => TbHtml::BUTTON_SIZE_LARGE)),
    )); 
}else{
     if(Yii::app()->user->isAdmin()){
            //se genera index para administrador
         $response = Yii::app()->user->obtenerNotificacionesGrafico();
         $this->widget(
    'yiiwheels.widgets.highcharts.WhHighCharts',
    array(
        'pluginOptions' => array(
            'title'  => array('text' => 'Gráfico de Actividad en los últimos 7 días'),
            'xAxis'  => array(
                'categories' => $response['categories']
            ),
            'yAxis'  => array(
                'title' => array('text' => 'Cantidad')
            ),
            'series' => array(
                array('name' => 'Notificaciones Generadas', 'data' => $response['dataNotificaciones']),
                array('name' => 'Usuarios registrados', 'data' => $response['dataRegistrados']),
            )
        )
    )
);
     }else{
         //se genera index para usuario
         $mensajes = Yii::app()->user->verificaAvisos();
         foreach($mensajes as $msg){
             Yii::app()->user->setFlash($msg['color'],$msg['msg']);
            $this->widget('bootstrap.widgets.TbAlert', array('block'=>true, ));
         }
         
     }
}
?>
