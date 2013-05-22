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
class UserProfile extends CActiveRecord
{
        //
        public $old_password;
        
        // 
        public $repeat_new_password;
        
        // 
        public $current_password;

        //
        public $new_password;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserProfile the static model class
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
			array('current_password, new_password, repeat_new_password', 'required'),
			array('username', 'length', 'max'=>64),
			array('password, current_password, new_password, repeat_new_password', 'length', 'max'=>1024),
                        
                        //array('current_password', 'validateCurrentPassword', 'messages'=>'This is not your password'),
                        //array('current_password', 'compare', 'compareAttribute'=>'password'),
                    
                        array('repeat_new_password', 'compare', 'compareAttribute'=>'new_password'),   
                        
                    
			array('name', 'length', 'max'=>128),
			array('foto', 'length', 'max'=>4000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, current_password, new_password, repeat_new_password, name, foto', 'safe', 'on'=>'search'),
		);
	}
        
        protected function beforeValidate()
        {
            $this->current_password = md5($this->current_password);
            return parent::beforeValidate();
        }
        
        protected function createPasswordHash($password)
        {
            return md5($password);
        }

        /**
         * I don't know how you access user's password as well.
         *
         * @return string
         */
        protected function getUserPassword()
        {
            return Yii::app()->user->get()->user->password;
        }

        /**
         * Saves the new password.
         */
        public function saveNewPassword()
        {
            $user = User::findByPk(Yii::app()->user->get()->user->id);
            $user->password = $this->createPasswordHash($this->new_password);
            $user->update();
        }

        /**
         * Validates current password.
         *
         * @return bool Is password valid
         */
        public function validateCurrentPassword()
        {
            return $this->createPasswordHash($this->current_password) == $this->getUserPassword();
        }
        
        //
        /*
        public function beforeSave()
        {
		if(parent::beforeSave()) { 
                    
                    $this->password = md5($this->new_password);
                    
                    $curr_password = User::model()->findByPk(Yii::app()->use->get()->user->id)->password;
                    $new_password = md5($this->new_password);
                    if($new_password==$curr_password){
                        $this->save();
                    }
                    
		}

		return true;
        }
        */

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'userRoles' => array(self::HAS_MANY, 'UserRole', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
                        'password' => 'Password',
			'current_password' => 'Current Password',
                        'new_password' => 'New Password',
                        'repeat_new_password' => 'Re-type New Password',
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
		$criteria->compare('username',$this->username,true);
                $criteria->compare('password',$this->password,true);
		$criteria->compare('current_password',$this->current_password,true);
                $criteria->compare('new_password',$this->new_password,true);
                $criteria->compare('repeat_new_password',$this->repeat_new_password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('foto',$this->foto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}