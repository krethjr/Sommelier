<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;

    public function authenticate()
    {
        $user = User::model()->find('LOWER(username)=?', array(strtolower($this->username)));
        if ($user === null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        elseif (!$user->validatePassword($this->password))
        {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }
        elseif ($user->account_status_cd == 'S')
        {
            $this->errorCode = self::ERROR_SUSPENDED;
        }
        else
        {
            $this->_id = $user->id;
            $this->username = $user->username;
            $this->setState('lastLogin', date("m/d/y g:i A", strtotime($user->last_login_dt)));
            $user->saveAttributes(array(
                'last_login_dt' => date("Y-m-d H:i:s", time()),
            ));
            $this->errorCode = self::ERROR_NONE;
	    Yii::app()->user->setState('isSiteAdmin', $user->isSiteAdmin());
	    Yii::app()->user->setState('isCellarAdmin', $user->isCellarAdmin());
	    Yii::app()->user->setState('isCellarUser', $user->isCellarUser());
        }
        return $this->errorCode == self::ERROR_NONE;
    }

    public function getId()
    {
        return $this->_id;
    }
}
