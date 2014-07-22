<?php

/**
 * This is the model class for table "{{wines}}".
 *
 * The followings are the available columns in table '{{wines}}':
 * @property integer $id
 * @property string $wine_name
 * @property integer $winery_id
 * @property integer $appellation_id
 * @property string $wine_year
 * @property integer $wine_varietal_id
 * @property string $create_dt
 * @property string $bottle_size
 * @property string $image_file
 * @property integer $overall_rating
 * @property string $description
 *
 * The followings are the available model relations:
 * @property CellarWines[] $cellarWines
 * @property WineComments[] $wineComments
 * @property Wineries $winery
 * @property Appellations $appellation
 * @property Varietals $wineVarietal
 */
class Wines extends CActiveRecord
{
    public $image;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{wines}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('wine_name, winery_id, appellation_id, wine_year, wine_varietal_id', 'required'),
            array('winery_id, appellation_id, wine_varietal_id, overall_rating', 'numerical', 'integerOnly' => true),
            array('wine_name', 'length', 'max' => 45),
            array('bottle_size', 'length', 'max' => 15),
            array('wine_year', 'length', 'max' => 4),
            array('image', 'file', 'allowEmpty' => true, 'types' => 'jpg,jpeg,gif,png', 'maxSize'=>1500000),
            array('description', 'length', 'max' => 255, 'on' => 'insert, update'),
            array('create_dt', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'insert'),
            array('id, wine_name, winery_id, appellation_id, wine_year, wine_varietal_id, overall_rating', 'safe', 'on' => 'search'),
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
            'cellarWines' => array(self::HAS_MANY, 'CellarWines', 'wine_id'),
            'wineComments' => array(self::HAS_MANY, 'WineComments', 'wine_id'),
            'winery' => array(self::BELONGS_TO, 'Wineries', 'winery_id'),
            'appellation' => array(self::BELONGS_TO, 'Appellations', 'appellation_id'),
            'wineVarietal' => array(self::BELONGS_TO, 'Varietals', 'wine_varietal_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'wine_name' => 'Wine Name',
            'winery_id' => 'Winery',
            'appellation_id' => 'Appellation',
            'wine_year' => 'Vintage',
            'wine_varietal_id' => 'Varietal',
            'create_dt' => 'Create Dt',
            'bottle_size' => 'Size',
            'image_file' => 'Image Filename',
            'overall_rating' => 'Avg Rating',
            'description' => 'Description',
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
        $criteria->compare('wine_name', $this->wine_name, true);
        $criteria->compare('winery_id', $this->winery_id);
        $criteria->compare('appellation_id', $this->appellation_id);
        $criteria->compare('wine_year', $this->wine_year, true);
        $criteria->compare('wine_varietal_id', $this->wine_varietal_id);
        $criteria->compare('overall_rating', $this->overall_rating);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Wines the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return a wine CA record with a random wine selected with an overall rating of 90 or greate
     */
    public function getRandomWine()
    {
        $criteria = new CDbCriteria(array(
            'condition' => 'overall_rating > 89',
            'limit' => 1,
            'offset' => 0,
            'order' => 'RAND()'
        ));

        $wotd = Wines::model()->find($criteria);

        return $wotd;
    }

    /**
     * @return string the associated database table name
     */
    public function refreshRating($wine_id)
    {
        $newRatingAvg = 0;

        $currWine = Wines::model()->findByPk($wine_id);

        $wineInCellars = new CellarWines();

        $this->overall_rating = $newRatingAvg;

        // propogate the result of saving to the calling code
        return $currWine->save();
    }
}
