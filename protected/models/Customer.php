<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property integer $id
 * @property integer $customer_info_id
 * @property integer $customer_category_id
 * @property integer $propinsi_id
 * @property integer $kota_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $mobile_phone
 * @property string $no_ktp
 * @property string $no_sim
 * @property string $alamat
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Propinsi $propinsi
 * @property Kota $kota
 * @property CustomerCategory $customerCategory
 * @property CustomerInfo $customerInfo
 * @property DetailKendaraan[] $detailKendaraans
 * @property Penjualan[] $penjualans
 * @property Registrasi[] $registrasis
 */
class Customer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Customer the static model class
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
		return 'customer';
	}
        
        

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('customer_info_id, customer_category_id, name, alamat, mobile_phone, propinsi_id, kota_id', 'required'),
			array('name, no_ktp, mobile_phone, alamat, propinsi_id, kota_id', 'required'),
			array('customer_info_id, customer_category_id, propinsi_id, kota_id', 'numerical', 'integerOnly'=>true),
			array('name, email', 'length', 'max'=>128),
			array('phone, mobile_phone', 'length', 'max'=>64),
			array('no_ktp, no_sim', 'length', 'max'=>32),
			array('alamat', 'length', 'max'=>256),
			array('status', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, customer_info_id, customer_category_id, propinsi_id, kota_id, name, email, phone, mobile_phone, no_ktp, no_sim, alamat, status', 'safe', 'on'=>'search'),
		);
	}
        
        
        
        public function beforeSave() {

            if(parent::beforeSave() && $this->isNewRecord) {
                $this->status = 1;
            }
            return true;
            
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'propinsi' => array(self::BELONGS_TO, 'Propinsi', 'propinsi_id'),
			'kota' => array(self::BELONGS_TO, 'Kota', 'kota_id'),
			'customerCategory' => array(self::BELONGS_TO, 'CustomerCategory', 'customer_category_id'),
			'customerInfo' => array(self::BELONGS_TO, 'CustomerInfo', 'customer_info_id'),
			'detailKendaraan' => array(self::HAS_MANY, 'DetailKendaraan', 'customer_id'),
			'penjualan' => array(self::HAS_MANY, 'Penjualan', 'customer_id'),
			'registrasi' => array(self::HAS_MANY, 'Registrasi', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'customer_info_id' => 'Customer Info',
			'customer_category_id' => 'Customer Category',
			'propinsi_id' => 'Propinsi',
			'kota_id' => 'Kota',
			'name' => 'Name',
			'email' => 'Email',
			'phone' => 'Phone',
			'mobile_phone' => 'Mobile Phone',
			'no_ktp' => 'No Ktp',
			'no_sim' => 'No Sim',
			'alamat' => 'Alamat',
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
		$criteria->compare('customer_info_id',$this->customer_info_id);
		$criteria->compare('customer_category_id',$this->customer_category_id);
		$criteria->compare('propinsi_id',$this->propinsi_id);
		$criteria->compare('kota_id',$this->kota_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile_phone',$this->mobile_phone,true);
		$criteria->compare('no_ktp',$this->no_ktp,true);
		$criteria->compare('no_sim',$this->no_sim,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('status',$this->status,true);
                
                $criteria->with = array(
                    'propinsi'=>array('select'=>'propinsi.name'),
                    'kota'=>array('select'=>'kota.name'),
                );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function afterFind() {
		$this->name = $this->name;
	}
        
        
        public function getData(){
            $model = Yii::app()->db->createCommand()
                    ->select("id, concat(name, ' [ ', no_ktp, ' ] ') as name")
                    ->from('customer')
                    ->order('id desc')
                    ->queryAll();
            return $model;           
        }
        
}