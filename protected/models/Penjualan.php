<?php

/**
 * This is the model class for table "penjualan".
 *
 * The followings are the available columns in table 'penjualan':
 * @property integer $id
 * @property integer $organisation_id
 * @property integer $parent_id
 * @property integer $user_role_id
 * @property integer $customer_id
 * @property string $kd_penjualan
 * @property string $code
 * @property string $date
 * @property double $total
 * @property double $bayar
 * @property double $total_bruto
 * @property double $total_diskon
 * @property double $pembulatan
 * @property double $total_netto
 * @property string $save
 * @property string $status
 *
 * The followings are the available model relations:
 * @property DetailPenjualan[] $detailPenjualans
 * @property Organisation $organisation
 * @property UserRole $userRole
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
                        array('kd_penjualan', 'required'),
			array('organisation_id, user_role_id', 'numerical', 'integerOnly'=>true),
			array('total, bayar, total_bruto, total_diskon, pembulatan, total_netto', 'numerical'),
			array('kd_penjualan', 'length', 'max'=>256),
			array('code', 'length', 'max'=>1024),
			array('save', 'length', 'max'=>32),
                        array('status', 'length', 'max'=>16),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, organisation_id, parent_id, user_role_id, customer_id, kd_penjualan, code, date, total, bayar, total_bruto, total_diskon, pembulatan, total_netto, save, status', 'safe', 'on'=>'search'),
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
			'detailPenjualan' => array(self::HAS_MANY, 'DetailPenjualan', 'penjualan_id'),
			'organisation' => array(self::BELONGS_TO, 'Organisation', 'organisation_id'),
			'userRole' => array(self::BELONGS_TO, 'UserRole', 'user_role_id'),
			'customer' => array(self::BELONGS_TO, 'Customer', '', 'on'=>'customer.no_ktp=t.customer_id'),
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
			'parent_id' => 'Parent',
			'user_role_id' => 'User Role',
			'customer_id' => 'Customer',
			'kd_penjualan' => 'Invoice',
			'code' => 'Code',
			'date' => 'Date',
			'total' => 'Total',
			'bayar' => 'Bayar',
			'total_bruto' => 'Total Bruto',
			'total_diskon' => 'Total Diskon',
			'pembulatan' => 'Pembulatan',
			'total_netto' => 'Total Netto',
			'save' => 'Save',
                        'status' => 'Status'
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('user_role_id',$this->user_role_id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('kd_penjualan',$this->kd_penjualan,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('bayar',$this->bayar);
		$criteria->compare('total_bruto',$this->total_bruto);
		$criteria->compare('total_diskon',$this->total_diskon);
		$criteria->compare('pembulatan',$this->pembulatan);
		$criteria->compare('total_netto',$this->total_netto);
		$criteria->compare('save',$this->save,true);
                $criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
	public function getRowCountByGerai($gerai, $year){

		$model = Yii::app()->db->createCommand()
			->select('count(*) + 1')
			->from('penjualan')
			->where("date LIKE '$year%' AND organisation_id = '$gerai'")
			->queryScalar();
		
		if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		return $model;
		
	}
}