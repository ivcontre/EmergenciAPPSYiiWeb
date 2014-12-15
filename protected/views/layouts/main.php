<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        
        <script type="text/javascript"
            src="http://maps.googleapis.com/maps/api/js?key=AIzaSyABFOUcj13ijdy8NXET-QDrMTFzVEvbMEY&sensor=false">
        </script>
        
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/funciones.js"></script>
        <!--link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/protected/extensions/YiiBootstrap-master/css/bootstrap.css" media="print" /-->
        <?php Yii::app()->bootstrap->register(); ?>

         
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
        
</head>

<body >
<?PHP
$this->widget('bootstrap.widgets.TbNavbar', array(
                'color' => TbHtml::NAVBAR_COLOR_INVERSE,
                'brandLabel' => '<img class="perfil" src="'.Yii::app()->request->baseUrl.'/icons/logo_nombre_37x74.png"> ',
                'collapse' => true,
                //'encodeLabel'=>false,
                'items' => array(
                                array(
                                    'class' => 'bootstrap.widgets.TbNav',
                                    'encodeLabel'=>false,
                                    'items' => array(
                                        array('label'=>'<img class="home" src="'.Yii::app()->request->baseUrl.'/icons/home_37x37.png"> Inicio', 'url'=>array('/site/index')),                                        
                                        array('label'=>'<img class="registrarse" src="'.Yii::app()->request->baseUrl.'/icons/registrarse_37x37.png"> Registrarse', 'url'=>array('/site/register'),'visible'=>Yii::app()->user->isGuest),
                                        //Menu administrador
                                        array('label'=>'<img class="centro_medico" src="'.Yii::app()->request->baseUrl.'/icons/centro_medico_37x37.png"> Centros Médicos', 'url'=>array('/centroMedico/admin'), 'visible'=>Yii::app()->user->isAdmin()),
                                        array('label'=>'<img class="bombero" src="'.Yii::app()->request->baseUrl.'/icons/bombero_37x37.png"> Bomberos', 'url'=>array('/bombero/admin'), 'visible'=>Yii::app()->user->isAdmin()),
                                        array('label'=>'<img class="carabinero" src="'.Yii::app()->request->baseUrl.'/icons/carabinero_37x37.png"> Carabineros', 'url'=>array('/carabinero/admin'),'visible'=>Yii::app()->user->isAdmin()),
                                        array('label'=>'<img class="pdi" src="'.Yii::app()->request->baseUrl.'/icons/pdi_37x37.png"> PDI', 'url'=>array('/pdi/admin'), 'visible'=>Yii::app()->user->isAdmin()),
                                        array('label'=>'<img class="comuna" src="'.Yii::app()->request->baseUrl.'/icons/comuna_37x37.png"> Comunas', 'url'=>array('/comuna/admin'),'visible'=>Yii::app()->user->isAdmin()),
                                        // Menu usuario
                                        array('label'=>'<img class="centro_medico" src="'.Yii::app()->request->baseUrl.'/icons/centro_medico_37x37.png"> Centros Médicos', 'url'=>array('/centroMedico/index'), 'visible'=>Yii::app()->user->isUser()),
                                        array('label'=>'<img class="bombero" src="'.Yii::app()->request->baseUrl.'/icons/bombero_37x37.png"> Bomberos', 'url'=>array('/bombero/index'), 'visible'=>Yii::app()->user->isUser()),
                                        array('label'=>'<img class="carabinero" src="'.Yii::app()->request->baseUrl.'/icons/carabinero_37x37.png"> Carabineros', 'url'=>array('/carabinero/index'),'visible'=>Yii::app()->user->isUser()),
                                        array('label'=>'<img class="pdi" src="'.Yii::app()->request->baseUrl.'/icons/pdi_37x37.png"> PDI', 'url'=>array('/pdi/index'), 'visible'=>Yii::app()->user->isUser()),
                                        array('label'=>'<img class="seguimiento" src="'.Yii::app()->request->baseUrl.'/icons/seguimiento_37x37.png"> Seguimiento '.Yii::app()->user->countAlertas(),'url'=>array('/contacto/seguimiento'), 'visible'=>Yii::app()->user->isUser()),
                                        //array("<li><a>".Yii::app()->user->countAlertas()."</a></li>",'visible'=>Yii::app()->user->isUser()),
                                        array('label'=>'<img class="perfil" src="'.Yii::app()->request->baseUrl.'/icons/perfil_37x37.png"> Perfil','items'=>array(
                                                        array('label'=>'Ver Perfil','url'=>array('usuario/view', 'id'=>Yii::app()->user->id), 'visible'=>Yii::app()->user->isUser()),
                                                        array('label'=>'Mis Contactos','url'=>array('contacto/admin'), 'visible'=>Yii::app()->user->isUser()),
                                                        array('label'=>'Configuracion','url'=>array('configuracion/update&id='.Yii::app()->user->idConfiguracion), 'visible'=>Yii::app()->user->isUser()),
                                                        array('label'=>'Cuenta','url'=>array('usuario/update&id='.Yii::app()->user->id), 'visible'=>Yii::app()->user->isUser()),
                                                        TbHtml::menuDivider(),
                                                        array('label'=>'Cerrar Sesión ('.Yii::app()->user->nombre.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                                            
                                            )
                                           , 'visible'=>Yii::app()->user->isUser()),
                                        
                                        array('label'=>'<img class="perfil" src="'.Yii::app()->request->baseUrl.'/icons/perfil_37x37.png"> Iniciar Sesión', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                        array('label'=>'<img class="perfil" src="'.Yii::app()->request->baseUrl.'/icons/perfil_37x37.png"> Perfil','items'=>array(                                                     
                                                        array('label'=>'Cuenta','url'=>array('usuario/view&id='.Yii::app()->user->id), 'visible'=>Yii::app()->user->isAdmin()),
                                                        TbHtml::menuDivider(),
                                                        array('label'=>'Cerrar Sesión ('.Yii::app()->user->nombre.')', 'url'=>array('/site/logout'), 'visible'=>Yii::app()->user->isAdmin())
                                            
                                            )
                                           , 'visible'=>Yii::app()->user->isAdmin()),
                                        
                                    ),
                                ),
                    )));
?>

<div  class="container" id="page">

	<div id="mainmenu">
		<?php 
//                $this->widget('zii.widgets.CMenu',array(
//			'items'=>array(
//				array('label'=>'Home', 'url'=>array('/site/index')),
//                                array('label'=>'Centros Médicos', 'url'=>array('/centroMedico/index')),
//                                array('label'=>'Bomberos', 'url'=>array('/bombero/index')),
//                                array('label'=>'Carabineros', 'url'=>array('/carabinero/index')),
//                                array('label'=>'PDI', 'url'=>array('/pdi/index')),
//                                array('label'=>'Comunas', 'url'=>array('/comuna/index')),
//				
//				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
//				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
//			),
//		)); 
                
                
                ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php 
//                $this->widget('zii.widgets.CBreadcrumbs', array(
//			'links'=>$this->breadcrumbs,
//		)); 
                $this->widget('bootstrap.widgets.TbBreadcrumb', array(
			'links'=>$this->breadcrumbs,
		)); 
                ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

</div><!-- page -->
<footer class="footer" id="footer">
            <p class="credit">Desarrollado por Iván Contreras y Renato Hormazabal</p>
</footer>
</body>
    
</html>
