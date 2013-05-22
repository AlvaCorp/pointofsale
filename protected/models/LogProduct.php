<?php

/**
 * This is the model class for table "log_product".
 *
 * The followings are the available columns in table 'log_product':
 * @property integer $id
 * @property integer $user_role_id
 * @property integer $product_id
 * @property double $harga
 * @property double $diskon
 * @property string $date_create
 *
 * The followings are the available model relations:
 * @property UserRole $userRole
 * @property Product $product
 */
class LogProduct extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LogProduct the static model class
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
		return 'log_product';
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
			array('id, user_role_id, product_id', 'numerical', 'integerOnly'=>true),
			array('harga, diskon', 'numerical'),
			array('date_create', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_role_id, product_id, harga, diskon, date_create', 'safe', 'on'=>'search'),
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
			'userRole' => array(self::BELONGS_TO, 'UserRole', 'user_role_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
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
			'product_id' => 'Product',
			'harga' => 'Harga',
			'diskon' => 'Diskon',
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
		$criteria->compare('user_role_id',$this->user_role_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('harga',$this->harga);
		$criteria->compare('diskon',$this->diskon);
		$criteria->compare('date_create',$this->date_create,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}