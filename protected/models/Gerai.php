<?php

/**
 * This is the model class for table "gerai".
 *
 * The followings are the available columns in table 'gerai':
 * @property integer $id
 * @property integer $gerai_owner_id
 * @property string $kode
 * @property string $name
 * @property string $alamat
 * @property string $telp
 *
 * The followings are the available model relations:
 * @property DetailPembelian[] $detailPembelians
 * @property GeraiOwner $geraiOwner
 * @property Product[] $products
 */
class Gerai extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Gerai the static model class
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
		return 'gerai';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, gerai_owner_id', 'numerical', 'integerOnly'=>true),
			array('kode, telp', 'length', 'max'=>64),
			array('name', 'length', 'max'=>128),
			array('alamat', 'length', 'max'=>512),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gerai_owner_id, kode, name, alamat, telp', 'safe', 'on'=>'search'),
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
			'detailPembelians' => array(self::HAS_MANY, 'DetailPembelian', 'gerai_id'),
			'geraiOwner' => array(self::BELONGS_TO, 'GeraiOwner', 'gerai_owner_id'),
			'products' => array(self::HAS_MANY, 'Product', 'gerai_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'gerai_owner_id' => 'Gerai Owner',
			'kode' => 'Kode',
			'name' => 'Name',
			'alamat' => 'Alamat',
			'telp' => 'Telp',
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
		$criteria->compare('gerai_owner_id',$this->gerai_owner_id);
		$criteria->compare('kode',$this->kode,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('telp',$this->telp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}