<?php

/**
 * This is the model class for table "merk_product".
 *
 * The followings are the available columns in table 'merk_product':
 * @property integer $id
 * @property string $kd_merk
 * @property string $name
 * @property integer $matrix
 *
 * The followings are the available model relations:
 * @property Product[] $products
 */
class MerkProduct extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MerkProduct the static model class
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
		return 'merk_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('matrix', 'numerical', 'integerOnly'=>true),
			array('kd_merk', 'length', 'max'=>128),
			array('name', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, kd_merk, name, matrix', 'safe', 'on'=>'search'),
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
			'products' => array(self::HAS_MANY, 'Product', 'merk_product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kd_merk' => 'Kd Merk',
			'name' => 'Name',
			'matrix' => 'Matrix',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('kd_merk',$this->kd_merk,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('matrix',$this->matrix);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function matrix($merk, $kendaraan){
		if($merk == 17)
			if($kendaraan == 1 or $kendaraan == 2)
				return 4;
			else
				return 1;
			
		else if($merk == 18)
			if($kendaraan == 1 or $kendaraan == 2)
				return 5;
			else 
				return 2;
		
		else if($merk == 19)
			if($kendaraan == 1 or $kendaraan == 2)
				return 6;
			else
				return 3;
		
		
	}
}