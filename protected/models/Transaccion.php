<?php

/**
 * This is the model class for table "transaccion".
 *
 * The followings are the available columns in table 'transaccion':
 * @property integer $id_Transaccion
 * @property integer $id_vendedor
 * @property integer $id_producto
 * @property string $placa
 * @property integer $valorTotal
 * @property string $fecha
 *
 * The followings are the available model relations:
 * @property Taxi $placa0
 * @property Vendedor $idVendedor
 * @property Producto $idProducto
 */
class Transaccion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Transaccion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'transaccion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_vendedor, id_producto, placa, valorTotal', 'required'),
			array('id_vendedor, id_producto, valorTotal', 'numerical', 'integerOnly'=>true),
			array('placa', 'length', 'max'=>6),
			array('fecha', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_Transaccion, id_vendedor, id_producto, placa, valorTotal, fecha', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'placa0' => array(self::BELONGS_TO, 'Taxi', 'placa'),
			'idVendedor' => array(self::BELONGS_TO, 'Vendedor', 'id_vendedor'),
			'idProducto' => array(self::BELONGS_TO, 'Producto', 'id_producto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_Transaccion' => 'Transaccion numero',
			'id_vendedor' => 'Vendedor',
			'id_producto' => 'Producto',
			'placa' => 'Placa',
			'valorTotal' => 'Valor',
			'fecha' => 'Fecha',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_Transaccion',$this->id_Transaccion);
		$criteria->compare('id_vendedor',$this->id_vendedor);
		$criteria->compare('id_producto',$this->id_producto);
		$criteria->compare('placa',$this->placa,true);
		$criteria->compare('valorTotal',$this->valorTotal);
		$criteria->compare('fecha',$this->fecha,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        /*public function behaviors() {
            return array(
            'CTimestampBehavior' => array(
            'class' => 'zii.behaviors.CTimestampBehavior',
            'createAttribute' => 'fecha',
            //'updateAttribute' => 'modified_date',
            'setUpdateOnCreate' => true,
            ),
            );
        }
         * 
         */
}