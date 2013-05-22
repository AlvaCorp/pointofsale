<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebUser
 *
 * @author sani
 */
class WebUser extends CWebUser {
    //put your code here
    private $_model;

    public function checkAccess($operation, $params=array())
    {
        if (empty($this->id)) {
            // Not identified => no rights
            return false;
        }
        //$role = $this->getState("roles");
        $roles = explode(',', $this->getState("roles"));

        //if ($role === 'admin') {
        //    return true; // admin role has access to everything
        //}
        
        if (in_array('admin', $roles) || in_array($operation, $roles)){
           return true;
        }
        
        //if (strstr($operation,$role) !== false) { // Check if multiple roles are available
        //    return true;
        //}
        // allow access if the operation request is the current user's role
        return ($operation === $roles);
    }
    
    public function get(){
            $user_id = Yii::app()->user->getId();
            $user=UserRole::model()->find(array('with'=>array('user', 'role'), 'condition'=>"user.id='$user_id' and t.status='1'"));
            return $user;
    }
    
    
    public function role(){
        $role_id = Yii::app()->user->get()->role_id;
        //$model = UserRole::model()->find(array('with'=>array('role')))
        $model = Role::model()->find(array('with'=>array('organisation'), 'condition'=>"t.id='$role_id'"));
        return $model;
    }
    
    public function bio(){
        $user_id = Yii::app()->user->getId();
        $model = Pegawai::model()->find(array('condition'=>"user_id='$user_id'"));
        return $model;
    }
}

?>
