<?php
/* @var $this ConductorController */
/* @var $model Conductor */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'conductor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_conductor'); ?>
		<?php echo $form->textField($model,'id_conductor'); ?>
		<?php echo $form->error($model,'id_conductor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'placa'); ?>
		<?php // echo $form->textField($model,'placa',array('size'=>6,'maxlength'=>6)); ?>
                <?php echo CHtml::dropDownList('Conductor[placa]',$model->placa,CHtml::listData(Taxi::model()->findAll(), "placa", "placa"),array('empty'=>'--Seleccione un taxi--')); ?>
		<?php echo $form->error($model,'placa'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->