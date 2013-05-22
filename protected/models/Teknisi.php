<?php

/**
 * This is the model class for table "teknisi".
 *
 * The followings are the available columns in table 'teknisi':
 * @property integer $id
 * @property integer $user_id
 * @property integer $propinsi_id
 * @property integer $kota_id
 * @property string $name
 * @property string $alamat
 * @property string $email
 * @property string $phone
 * @property string $mobile_phone
 * @property string $status
 *
 * The followings are the available model relations:
 * @property LogKendaraan[] $logKendaraans
 * @property Perawatan[] $perawatans
 * @property Kota $kota
 * @property User $user
 * @property Propinsi $propinsi
 */
class Teknisi extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Teknisi the static model class
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
		return 'teknisi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, propinsi_id, kota_id, alamat', 'required'),
			array('user_id, propinsi_id, kota_id', 'numerical', 'integerOnly'=>true),
			array('name, email', 'length', 'max'=>128),
			array('alamat', 'length', 'max'=>512),
			array('phone, mobile_phone', 'length', 'max'=>64),
			array('status', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, propinsi_id, kota_id, name, alamat, email, phone, mobile_phone, status', 'safe', 'on'=>'search'),
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
			'logKendaraans' => array(self::HAS_MANY, 'LogKendaraan', 'teknisi_id'),
			'perawatans' => array(self::HAS_MANY, 'Perawatan', 'teknisi_id'),
			'kota' => array(self::BELONGS_TO, 'Kota', 'kota_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'propinsi' => array(self::BELONGS_TO, 'Propinsi', 'propinsi_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'propinsi_id' => 'Propinsi',
			'kota_id' => 'Kota',
			'name' => 'Name',
			'alamat' => 'Alamat',
			'email' => 'Email',
			'phone' => 'Phone',
			'mobile_phone' => 'Mobile Phone',
			'status' => 'Status',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('propinsi_id',$this->propinsi_id);
		$criteria->compare('kota_id',$this->kota_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile_phone',$this->mobile_phone,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}