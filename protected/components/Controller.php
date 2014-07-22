<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    public $userData;

    /**
     * Adding init to set userData and theme 
     */
    public function init()
    {
        //read and store current user data so it's available in all controllers
        if (!Yii::app()->user->isGuest)
        {
            $this->userData = User::model()->findByPk(Yii::app()->user->id);
        }
        
        //theme defaults to classic in config/main.php
        //we set it here to either mobile or tablet as appropriate

        $detector = Yii::app()->mobileDetect;

        if ($detector->isTablet())
        {
            Yii::app()->theme = 'tablet';
        }
        elseif ($detector->isMobile())
        {
            Yii::app()->theme = 'mobile';
        };
        parent::init();
    }
    
    /**
     * Test required user roles 
     */
    public function allowRole($roles)
    {
        if (substr_count($roles, $this->userData->user_role) == 0)
        {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

}