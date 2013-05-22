<?php

/**
 * This is the model class for table "detail_kendaraan".
 *
 * The followings are the available columns in table 'detail_kendaraan':
 * @property integer $id
 * @property string $kendaraan_id
 * @property string $customer_id
 * @property string $uid
 * @property string $nopol
 *
 * The followings are the available model relations:
 * @property Kendaraan $kendaraan
 * @property Customer $customer
 * @property KartuGaransi[] $kartuGaransis
 * @property LogKendaraan[] $logKendaraans
 * @property Perawatan[] $perawatans
 */
class DetailKendaraan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DetailKendaraan the static model class
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
		return 'detail_kendaraan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('uid, kendaraan_id, customer_id', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('nopol', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, kendaraan_id, customer_id, nopol', 'safe', 'on'=>'search'),
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
			'kendaraan' => array(self::BELONGS_TO, 'Kendaraan', 'kendaraan_id'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			'kartuGaransi' => array(self::HAS_MANY, 'KartuGaransi', 'detail_kendaraan_id'),
			'logKendaraan' => array(self::HAS_MANY, 'LogKendaraan', 'detail_kendaraan_id'),
			'perawatan' => array(self::HAS_MANY, 'Perawatan', 'detail_kendaraan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kendaraan_id' => 'Kendaraan',
			'customer_id' => 'Customer',
                        'uid' => 'Uniq Id',
			'nopol' => 'Nomor Polisi',
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
		$criteria->compare('kendaraan_id',$this->kendaraan_id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('nopol',$this->nopol,true);
                $criteria->compare('uid',$this->uid, true);
                
                $criteria->with = array(
                    'kendaraan'=>array('select'=>'kendaraan.id, kendaraan.no_mesin'),
                );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getMaxRow(){
		$model = Yii::app()->db->createCommand()
		  ->select('max(id)')
		  ->from('detail_kendaraan')
		  ->queryScalar();
		return $model + 1;
	}
}