<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $country
 * @property string $state
 * @property integer $favorite_region_id
 * @property string $profile
 * @property string $account_status_cd 
 * @property string $user_role 
 * @property string $create_dt
 * @property string $last_login_dt
 *
 * The followings are the available model relations:
 * @property Cellars[] $cellars
 * @property Regions $favoriteRegion
 * @property WineComments[] $wineComments
 */
class User extends CActiveRecord
{
    public $password_repeat;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username', 'unique',
                'className' => 'User',
                'attributeName' => 'username',
                'message' => 'This user name is already in use'),
            array('email', 'unique',
                'className' => 'User',
                'attributeName' => 'email',
                'message' => 'This Email is already in use'),
            array('username, email', 'required', 'on' => 'insert'),
            array('username, email', 'required', 'on' => 'update'),
            array('username, password, password_repeat, email', 'length', 'max' => 128),
            array('first_name, last_name, country', 'length', 'max' => 45),
            array('state', 'length', 'max' => 2),
            array('profile, create_dt, last_login_dt, password_repeat, account_status_cd, user_role', 'safe'),
            array('password', 'compare', 'on' => 'insert'),
            array('account_status_cd', 'default', 'value' => 'A', 'on' => 'insert'),
            array('user_role', 'default', 'value' => 'CELLAR_USER', 'on' => 'insert'),
            array('create_dt', 'default', 'value' => new CDbExpression('NOW()'), 'on' => 'insert'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, email, profile, create_dt, last_login_dt, first_name, last_name, country, state, favorite_region_id', 'safe', 'on' => 'search'),
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
            'cellars' => array(self::HAS_MANY, 'Cellars', 'owner_id'),
            'favoriteRegion' => array(self::BELONGS_TO, 'Regions', 'favorite_region_id'),
            'wineComments' => array(self::HAS_MANY, 'WineComments', 'user_id'),
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
            'email' => 'Email',
            'profile' => 'Profile',
            'create_dt' => 'Create Date-Time',
            'last_login_dt' => 'Last Login Date-Time',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'country' => 'Country',
            'state' => 'State',
            'favorite_region_id' => 'Favorite Region',
            'user_role' => 'User Role',
            'account_status_cd' => 'Account Status',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('profile', $this->profile, true);
        $criteria->compare('create_dt', $this->create_dt, true);
        $criteria->compare('last_login_dt', $this->last_login_dt, true);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('country', $this->country, true);
        $criteria->compare('state', $this->state, true);
        $criteria->compare('favorite_region_id', $this->favorite_region_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * apply a hash on the password before we store it in the database
     */
    protected function afterValidate()
    {
        parent::afterValidate();
        //ensure we don't have any other errors
        if (!$this->hasErrors())
            $this->password = $this->hashPassword($this->password);
    }

    /**
     * Generates the password hash.
     * @param string password
     * @return string hash
     */
    public function hashPassword($password)
    {
        return md5($password);
    }

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password)
    {
        return $this->hashPassword($password) === $this->password;
    }
    
    /**
     * return true is site_admin
     */
    public function isSiteAdmin()
    {
	return ($this->user_role === 'SITE_ADMIN');
    }

    /**
     * return true is cellar_admin
     */
    public function isCellarAdmin()
    {
	return ($this->user_role === 'CELLAR_ADMIN');
    }

    /**
     * return true is cellar_user
     */
    public function isCellarUser()
    {
	return ($this->user_role === 'CELLAR_USER');
    }

}
