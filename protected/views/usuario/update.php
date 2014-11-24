<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
if(Yii::app()->user->isUser()){
$this->breadcrumbs=array(
	'Perfil'=>array('usuario/view&id='.$model->numero_telefono),
	'Editar',
);

$this->menu=array(
	array('label'=>'Perfil', 'url'=>array('view', 'id'=>$model->numero_telefono)),
);
?>

<h1 class="white">Mi cuenta</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); 

}else{
    $this->breadcrumbs=array(
	'Cuenta'=>array('usuario/view&id='.$model->numero_telefono),
	'Editar',
    );

    $this->menu=array(
            array('label'=>'Cuenta', 'url'=>array('view', 'id'=>$model->numero_telefono)),
    );
    echo '<h2 class="white">Mi Cuenta <small>'.$model->nombre.'</small></h2>';
    $this->renderPartial('_form', array('model'=>$model)); 
}
?>
