<?php
/* @var $this FlotaController */
/* @var $model Flota */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#flota-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestionar Flotas</h1>
<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->

<?php echo CHtml::link('Busqueda avanzada', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'flota-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id_flota',
        'idCliente.nombre',
        array(
            'name' => 'sobrecupoApobado',
            'value' => '$data->sobrecupoApobado?"Si":"No"',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{aprobe}',
            'buttons' => array(
                'aprobe' => array(
                    'label' => 'Aprobar',
                    'url' => 'Yii::app()->createUrl("flota/aprobar", array("id"=>$data->id_flota))',
                    'visible' => '!$data->sobrecupoApobado',
                ),
            ),
        ),
    ),
));
?>
