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
     if(Yii::app()->user->name == "admin"){
            //se genera index para administrador
         
     }
}
?>
