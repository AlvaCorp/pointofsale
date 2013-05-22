<?php

/**
 * This is the model class for table "penjualan".
 *
 * The followings are the available columns in table 'penjualan':
 * @property integer $id
 * @property integer $organisation_id
 * @property integer $tipe_penjualan_id
 * @property integer $parent_id
 * @property integer $user_role_id
 * @property integer $log_kendaraan_id
 * @property integer $customer_id
 * @property string $kd_penjualan
 * @property string $code
 * @property string $date
 * @property double $total
 * @property double $bayar
 *
 * The followings are the available model relations:
 * @property DetailPenjualan[] $detailPenjualans
 * @property Organisation $organisation
 * @property TipePenjualan $tipePenjualan
 * @property UserRole $userRole
 * @property LogKendaraan $logKendaraan
 * @property Customer $customer
 */
class Penjualan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Penjualan the static model class
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
		return 'penjualan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('tipe_penjualan_id', 'required'),
			array('organisation_id, tipe_penjualan_id, parent_id, user_role_id, log_kendaraan_id, customer_id', 'numerical', 'integerOnly'=>true),
			array('total, bayar', 'numerical'),
			array('kd_penjualan', 'length', 'max'=>256),
			array('code', 'length', 'max'=>512),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, organisation_id, tipe_penjualan_id, parent_id, user_role_id, log_kendaraan_id, customer_id, kd_penjualan, code, date, total, bayar', 'safe', 'on'=>'search'),
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
			'detailPenjualans' => array(self::HAS_MANY, 'DetailPenjualan', 'penjualan_id'),
			'organisation' => array(self::BELONGS_TO, 'Organisation', 'organisation_id'),
			'tipePenjualan' => array(self::BELONGS_TO, 'TipePenjualan', 'tipe_penjualan_id'),
			'userRole' => array(self::BELONGS_TO, 'UserRole', 'user_role_id'),
			'logKendaraan' => array(self::BELONGS_TO, 'LogKendaraan', 'log_kendaraan_id'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'organisation_id' => 'Organisation',
			'tipe_penjualan_id' => 'Tipe Penjualan',
			'parent_id' => 'Parent',
			'user_role_id' => 'User Role',
			'log_kendaraan_id' => 'Log Kendaraan',
			'customer_id' => 'Customer',
			'kd_penjualan' => 'Kd Penjualan',
			'code' => 'Code',
			'date' => 'Date',
			'total' => 'Total',
			'bayar' => 'Bayar',
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
		$criteria->compare('organisation_id',$this->organisation_id);
		$criteria->compare('tipe_penjualan_id',$this->tipe_penjualan_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('user_role_id',$this->user_role_id);
		$criteria->compare('log_kendaraan_id',$this->log_kendaraan_id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('kd_penjualan',$this->kd_penjualan,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('bayar',$this->bayar);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}