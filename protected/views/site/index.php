<?php
/* @var $this SiteController */

//$this->pageTitle=Yii::app()->name;
if(Yii::app()->user->isGuest){
    // imagenes 830/477
    $carousel =  TbHtml::carousel(array(
        array('image' => Yii::app()->request->baseUrl.'/images/carabineros_prop.png', 'label' => 'Podrás Encontrar los Retenes de Carabineros cerca a tu ubicación', 'caption' => '...'),
        array('image' => Yii::app()->request->baseUrl.'/images/busqueda_prop.png', 'label' => 'Busca todos los servicios de ayuda por su comuna', 'caption' => '...'),
        array('image' => Yii::app()->request->baseUrl.'/images/ruta_prop.png', 'label' => 'Genera la ruta más cercana, y averigua como llegar de manera rápida', 'caption' => '...'),
    ));
    $this->widget('bootstrap.widgets.TbHeroUnit', array(
        'heading' => '',
        'content' => $carousel,
    ));
    echo '<div class="brillo">';
    echo '<p>Regístrate en nuestra página, descarga nuestra aplicación y sientete seguro en todo momento.</p>';
    echo '</div>';
    echo '<div class="brillo2">';
    echo '<a href="#"><img src="'.Yii::app()->request->baseUrl.'/icons/botondescarga.png" > </a>Descargar';
    //echo TbHtml::button('Descargar', array('color' =>TbHtml::BUTTON_COLOR_PRIMARY, 'size' => TbHtml::BUTTON_SIZE_LARGE));
    echo '</div>';
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
         $modelUser =  Yii::app()->user->getUsuario();
         $mensajes = Yii::app()->user->verificaAvisos();
         foreach($mensajes as $msg){
             Yii::app()->user->setFlash($msg['color'],$msg['msg']);
            $this->widget('bootstrap.widgets.TbAlert', array('block'=>true, ));
         }
         ?>
        <div class="row">
            <div class="span8">
                <?php
                    $response = Yii::app()->user->obtenerNotificacionesGraficoUsuario();
                    $this->widget(
                       'yiiwheels.widgets.highcharts.WhHighCharts',
                       array(
                           'pluginOptions' => array(
                               'title'  => array('text' => 'Notificaciones realizadas en los últimos 7 días'),
                               'xAxis'  => array(
                                   'categories' => $response['categories']
                               ),
                               'yAxis'  => array(
                                   'title' => array('text' => 'Cantidad')
                               ),
                               'series' => array(
                                   array('name' => 'Notificaciones Generadas', 'data' => $response['dataNotificaciones']),
                                   
                               )
                           )
                       )
                   );
                ?>
            </div>
            <div class="span4">
                <h1 ><small>Mis contactos</small></h1>
                <?php

                    $this->widget('bootstrap.widgets.TbGridView',array(
                        'type'=> TbHtml::GRID_TYPE_BORDERED,
                         'dataProvider' => new CActiveDataProvider('Contacto', array(
                             'data'=>$modelUser->contactos
                            
                         )),
                        'columns'=>array('numero','nombre', 'correo')
                            ));
                
                ?>

            </div>
        </div>


        <div class="row">
            <div class="span6">
                <h1 ><small>Configuración</small></h1>
                <?php 
                
                $this->widget('zii.widgets.CDetailView',array(
                    'htmlOptions' => array(
                        'class' => 'table table-striped table-condensed table-hover',
                    ),
                    'data'=>$modelUser->configuracion,
                    'nullDisplay'=>'sin valor aún',
                    'attributes'=>array(
                                'numero_usuario',
                                
                                'numero_carabinero',
                                'numero_bombero',
                                'numero_centro_medico',
                                'radio_busqueda',
                                'mensaje_alerta',
                                'fecha_modificacion',
                        ),
                )); ?>
            </div>
            <div class="span6">
                <h1 ><small>Cuenta</small></h1>
                <?php 
                
                $this->widget('zii.widgets.CDetailView',array(
                    'htmlOptions' => array(
                        'class' => 'table table-striped table-condensed table-hover',
                    ),
                    'data'=>$modelUser,
                    'nullDisplay'=>'sin valor aún',
                    'attributes'=>array(
                                'numero_telefono',
                                'nombre',
                                'apellido',
                                'correo',
                                
                        ),
                )); ?>
            </div>
        </div>
        
         <?php
         
     }
}
?>

