<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
if(Yii::app()->user->isUser()){
$this->breadcrumbs=array(
	'Perfil'=>array('usuario/view&id='.$model->numero_telefono),
	'Actualizar Contraseña',
);

$this->menu=array(
	array('label'=>'Perfil', 'url'=>array('view', 'id'=>$model->numero_telefono)),
);
?>

<h1 class="white">Actualizar Contraseña</h1>

<?php $this->renderPartial('_pass', array('model'=>$model)); 

}else{
    $this->breadcrumbs=array(
	'Cuenta'=>array('usuario/view&id='.$model->numero_telefono),
	'Actualizar Contraseña',
    );

    $this->menu=array(
            array('label'=>'Cuenta', 'url'=>array('view', 'id'=>$model->numero_telefono)),
    );
    echo "<h1 class='white'>Actualizar Contraseña <small>".$model->nombre."</small></h1>";
    $this->renderPartial('_pass', array('model'=>$model)); 
}
?>