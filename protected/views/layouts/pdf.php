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


<div  class="container" id="page">

	
	

	<?php echo $content; ?>

	

</div><!-- page -->

</body>
    
</html>