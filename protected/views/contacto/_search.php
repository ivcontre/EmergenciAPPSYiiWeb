<?php
/* @var $this ContactoController */
/* @var $model Contacto */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id_contacto',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'numero_telefono',array('span'=>5,'maxlength'=>15)); ?>

                    <?php echo $form->textFieldControlGroup($model,'nombre',array('span'=>5,'maxlength'=>50)); ?>

                    <?php echo $form->textFieldControlGroup($model,'numero',array('span'=>5,'maxlength'=>15)); ?>

                    <?php echo $form->textFieldControlGroup($model,'correo',array('span'=>5,'maxlength'=>25)); ?>

                    <?php echo $form->textFieldControlGroup($model,'estado',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'alerta_sms',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'alerta_gps',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'alerta_correo',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->