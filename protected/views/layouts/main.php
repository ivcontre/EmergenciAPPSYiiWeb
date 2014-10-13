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
                'brandLabel' => 'EmergenciAPPS',
                'collapse' => true,
                'items' => array(
                                array(
                                    'class' => 'bootstrap.widgets.TbNav',
                                    'items' => array(
                                        array('label'=>'Inicio', 'url'=>array('/site/index')),
                                        array('label'=>'Centros Médicos', 'url'=>array('/centroMedico/index')),
                                        array('label'=>'Bomberos', 'url'=>array('/bombero/index')),
                                        array('label'=>'Carabineros', 'url'=>array('/carabinero/index')),
                                        array('label'=>'PDI', 'url'=>array('/pdi/index')),
                                        array('label'=>'Comunas', 'url'=>array('/comuna/index')),
                                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                                    ),
                                ),
                    )));
?>
<div  class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

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

</body>
    <footer class="footer" id="footer">
        <div class="container">
            <p class="credit">Desarrollado por Iván Contreras y Renato Hormazabal</p>
        </div>
    </footer>
</html>
