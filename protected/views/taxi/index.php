<?php
/* @var $this TaxiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Taxis',
);

$this->menu=array(
	array('label'=>'Crear Taxi', 'url'=>array('create')),
	array('label'=>'Gestionar Taxi', 'url'=>array('admin')),
);
?>

<h1>Taxis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
