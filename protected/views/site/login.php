<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Iniciar Sesión';
?>
<br><br><br><br>
<div class="falso1">
<section class="falso">
<h1 >Inicio Sesión</h1>



<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note white">Campos con <span class="required">*</span> son requeridos.</p>

	<div class="row white">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row white">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
			Consejo: Debes logearte como <kbd>Usuario</kbd> o <kbd>Administrador</kbd>.
		</p>
	</div>

	<div class="row white rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="">
        <?php echo TbHtml::submitButton('Iniciar',array(
		    'color'=>TbHtml::BUTTON_COLOR_WARNING,
		    
		)); ?>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</section>
</div>
<br><br><br><br><br><br><br><br>
