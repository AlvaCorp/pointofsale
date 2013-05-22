<?php

/**
 * This is the model class for table "pegawai".
 *
 * The followings are the available columns in table 'pegawai':
 * @property integer $id
 * @property integer $user_id
 * @property integer $propinsi_id
 * @property integer $kota_id
 * @property integer $jabatan_id
 * @property string $name
 * @property string $alamat
 * @property string $email
 * @property string $phone
 * @property string $mobile_phone
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property PegawaiStatus $status0
 * @property Jabatan $jabatan
 * @property Kota $kota
 * @property Propinsi $propinsi
 * @property User $user
 */
class Pegawai extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pegawai the static model class
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
		return 'pegawai';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('kota_id, alamat, mobile_phone', 'required'),
			array('user_id, propinsi_id, kota_id, jabatan_id, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>512),
			array('alamat', 'length', 'max'=>1024),
			array('email, phone, mobile_phone', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, propinsi_id, kota_id, jabatan_id, name, alamat, email, phone, mobile_phone, status', 'safe', 'on'=>'search'),
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
			'status0' => array(self::BELONGS_TO, 'PegawaiStatus', 'status'),
			'jabatan' => array(self::BELONGS_TO, 'Jabatan', 'jabatan_id'),
			'kota' => array(self::BELONGS_TO, 'Kota', 'kota_id'),
			'propinsi' => array(self::BELONGS_TO, 'Propinsi', 'propinsi_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
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
			'jabatan_id' => 'Jabatan',
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
		$criteria->compare('jabatan_id',$this->jabatan_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile_phone',$this->mobile_phone,true);
		$criteria->compare('status',$this->status);
                $criteria->with = array(
                    'user'=>array('select'=>'user.name'),
                    'propinsi'=>array('select'=>'propinsi.name'),
                    'kota'=>array('select'=>'kota.name'),
                    'jabatan'=>array('select'=>'jabatan.name'),
                );
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}