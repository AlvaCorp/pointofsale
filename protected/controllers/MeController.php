<?php

class MeController extends Controller
{
    
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
                            array(
                                      'application.filters.YXssFilter',
                                      'clean'   => '*',
                                      'tags'    => 'strict',
                                      'actions' => 'all'
                            )
		);
	}
        
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
                        /*
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
                         * 
                         */
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index', 'view', 'admin', 'create','update', 'delete'),
				'users'=>array('@')
			),
                        /*
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
                        */
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
	public function actionIndex()
	{
                $new_model = UserProfile::model()->findByPk(Yii::app()->user->get()->user->id);
                $model = User::model()->findByPk(Yii::app()->user->get()->user->id);
                

                
                if(isset($_POST['UserProfile'])){
                    if(md5($_POST['UserProfile']['current_password']) === $model->password)
                    {
                       $user = UserProfile::model()->findByPk(Yii::app()->user->get()->user->id);
                       $user->setScenario('changePassword');
                       $user->attributes = $_POST['UserProfile'];                
                       $user->password = md5($_POST['UserProfile']['new_password']);
                       if($user->save())
                         Yii::app()->user->setFlash('passChanged', 'Your password has been changed <strong>successfully</strong>.');
                    }            
                    else
                    {
                      Yii::app()->user->setFlash('passChangeError', 'Your password was not changed because it did not matched the <strong>old password</strong>.');                    
                    }  
                }
                
		$this->render('index', array('model'=>$model, 'new_model'=>$new_model));
	}
        
        public function actionPassword(){
            $new_model = UserProfile::model()->findByPk(Yii::app()->user->get()->user->id);
            $model = User::model()->findByPk(Yii::app()->user->get()->user->id);



            if(isset($_POST['UserProfile'])){
                if(md5($_POST['UserProfile']['current_password']) === $model->password)
                {
                   $user = UserProfile::model()->findByPk(Yii::app()->user->get()->user->id);
                   $user->setScenario('changePassword');
                   $user->attributes = $_POST['UserProfile'];                
                   $user->password = md5($_POST['UserProfile']['new_password']);
                   if($user->save())
                     Yii::app()->user->setFlash('passChanged', 'Your password has been changed <strong>successfully</strong>.');
                }            
                else
                {
                  Yii::app()->user->setFlash('passChangeError', 'Your password was not changed because it did not matched the <strong>old password</strong>.');                    
                }  
            }
            $this->render('password', array('new_model'=>$new_model));
        }
        
        public function actionProfile(){
            $new_model = UserProfile::model()->findByPk(Yii::app()->user->get()->user->id);
            $model = User::model()->findByPk(Yii::app()->user->get()->user->id);
            $role = Role::model()->findByPk(Yii::app()->user->get()->role_id);



            if(isset($_POST['UserProfile'])){
                if(md5($_POST['UserProfile']['current_password']) === $model->password)
                {
                   $user = UserProfile::model()->findByPk(Yii::app()->user->get()->user->id);
                   $user->setScenario('changePassword');
                   $user->attributes = $_POST['UserProfile'];                
                   $user->password = md5($_POST['UserProfile']['new_password']);
                   if($user->save())
                     Yii::app()->user->setFlash('passChanged', 'Your password has been changed <strong>successfully</strong>.');
                }            
                else
                {
                  Yii::app()->user->setFlash('passChangeError', 'Your password was not changed because it did not matched the <strong>old password</strong>.');                    
                }  
            }
            $this->render('profile', array('model'=>$model, 'role'=>$role));
        }
        
        public function actionRole(){
            
            $id = Yii::app()->user->get()->id;
            $model = $this->loadRole($id);
            
            if(isset($_POST['UserRole'])){
                $model->attributes = $_POST['UserRole'];
                if($model->save()){
                    
                    Yii::app()->user->setFlash('passChanged', 'Your role has been changed<strong>successfully</strong>.');
                    
                    $this->redirect(array('site/logout'));
                    
                }            
                else
                {
                  $this->redirect(array('me/role'));
                  Yii::app()->user->setFlash('passChangeError', 'Something going wrong, Your role was not changed.');                    
                }  
            }
            

            $this->render('role', array('model'=>$model));
            
        }
        
	public function loadModel($id)
	{
		$model=Kendaraan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
	public function loadRole($id)
	{
		$model=UserRole::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kendaraan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

        // Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
       
}