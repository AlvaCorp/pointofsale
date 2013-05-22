<?php

/**
 * This is the model class for table "tipe_kendaraan".
 *
 * The followings are the available columns in table 'tipe_kendaraan':
 * @property integer $id
 * @property string $merk_kendaraan_id
 * @property string $kd_tipe_kendaraan
 * @property string $name
 * @property string $date_create
 */
class TipeKendaraan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TipeKendaraan the static model class
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
		return 'tipe_kendaraan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('merk_kendaraan_id, name', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('kd_tipe_kendaraan', 'length', 'max'=>32),
			array('name', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, merk_kendaraan_id, kd_tipe_kendaraan, name, date_create', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'merk_kendaraan_id' => 'Merk Kendaraan',
			'kd_tipe_kendaraan' => 'Kd Kendaraan',
			'name' => 'Name',
			'date_create' => 'Date Create',
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
		$criteria->compare('merk_kendaraan_id',$this->merk_kendaraan_id);
		$criteria->compare('kd_tipe_kendaraan',$this->kd_tipe_kendaraan,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('date_create',$this->date_create,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}