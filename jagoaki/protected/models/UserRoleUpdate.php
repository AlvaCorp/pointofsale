<?php

/**
 * This is the model class for table "user_role".
 *
 * The followings are the available columns in table 'user_role':
 * @property integer $id
 * @property integer $role_id
 * @property integer $user_id
 * @property string $status
 *
 * The followings are the available model relations:
 * @property KodeGaransi[] $kodeGaransis
 * @property LogProduct[] $logProducts
 * @property Pembelian[] $pembelians
 * @property Penjualan[] $penjualans
 * @property Session[] $sessions
 * @property Role $role
 * @property User $user
 */
class UserRoleUpdate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserRoleUpdate the static model class
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
		return 'user_role';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_id, user_id', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, role_id, user_id, status', 'safe', 'on'=>'search'),
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
			'kodeGaransis' => array(self::HAS_MANY, 'KodeGaransi', 'user_role_id'),
			'logProducts' => array(self::HAS_MANY, 'LogProduct', 'user_role_id'),
			'pembelians' => array(self::HAS_MANY, 'Pembelian', 'user_role_id'),
			'penjualans' => array(self::HAS_MANY, 'Penjualan', 'user_role_id'),
			'sessions' => array(self::HAS_MANY, 'Session', 'user_role_id'),
			'role' => array(self::BELONGS_TO, 'Role', 'role_id'),
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
			'role_id' => 'Role',
			'user_id' => 'User',
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
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}