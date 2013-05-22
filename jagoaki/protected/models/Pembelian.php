<?php

/**
 * This is the model class for table "pembelian".
 *
 * The followings are the available columns in table 'pembelian':
 * @property integer $id
 * @property integer $user_role_id
 * @property string $kd_pembelian
 * @property string $date
 * @property string $total
 * @property string $bayar
 *
 * The followings are the available model relations:
 * @property DetailPembelian[] $detailPembelians
 * @property UserRole $userRole
 */
class Pembelian extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pembelian the static model class
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
		return 'pembelian';
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
			array('id, user_role_id', 'numerical', 'integerOnly'=>true),
			array('kd_pembelian', 'length', 'max'=>256),
			array('total, bayar', 'length', 'max'=>32),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_role_id, kd_pembelian, date, total, bayar', 'safe', 'on'=>'search'),
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
			'detailPembelians' => array(self::HAS_MANY, 'DetailPembelian', 'pembelian_id'),
			'userRole' => array(self::BELONGS_TO, 'UserRole', 'user_role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_role_id' => 'User Role',
			'kd_pembelian' => 'Kd Pembelian',
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
		$criteria->compare('user_role_id',$this->user_role_id);
		$criteria->compare('kd_pembelian',$this->kd_pembelian,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('bayar',$this->bayar,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}