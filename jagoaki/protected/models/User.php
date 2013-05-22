<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id

 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $foto
 *
 * The followings are the available model relations:

 * @property UserRole[] $userRoles
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, name', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>64),
                        array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message'=>'Field can contain only alphanumeric characters.'),
			array('password', 'length', 'max'=>1024),
			array('name', 'length', 'max'=>128),
			array('foto', 'length', 'max'=>4000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, name, foto', 'safe', 'on'=>'search'),
		);
	}
        
        
         public function beforeSave() {

            if(parent::beforeSave() && $this->isNewRecord) {
                
                $record = User::model()->find(array('condition'=>"username='$this->username'"));
                if($record===NULL){
                    $this->password = md5($this->password);
                    return true;
                }else{
                    Yii::app()->user->setFlash('Error', '<strong>Gagal!</strong> Username sudah ada, <i>gunakan username lain</i>.');
                }
            }
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			//'gerai' => array(self::BELONGS_TO, 'Gerai', 'gerai_id'),
			'userRole' => array(self::HAS_MANY, 'UserRole', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			//'gerai_id' => 'Gerai',
			'username' => 'Username',
			'password' => 'Password',
			'name' => 'Name',
			'foto' => 'Foto',
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
		//$criteria->compare('gerai_id',$this->gerai_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('foto',$this->foto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}