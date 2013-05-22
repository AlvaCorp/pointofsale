<?php
class UserIdentity extends CUserIdentity
{
    private $_id;
    public function authenticate()
    {
        $record=UserRole::model()->find(array('with'=>array('user', 'role'), 'condition'=>"user.username='$this->username' and t.status='1'"));

        
        if($record===null){
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }

        else if($record->user->password!==md5($this->password)){
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        }
        
        else
        {   
            $this->_id=$record->user->id;
            $this->setState('title', $record->user->name);
            $this->setState('roles', $record->role->name);
            $this->setState('users', $record->user->username);
            $this->errorCode=self::ERROR_NONE;
        }

        return !$this->errorCode;
    }
 
    public function getId()
    {
        return $this->_id;
    }
}