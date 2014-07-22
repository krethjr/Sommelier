<?php

/**
 * This is the model class for table "tbl_cellars".
 *
 * The followings are the available columns in table 'tbl_cellars':
 * @property integer $id
 * @property integer $owner_id
 * @property string $cellar_name
 * @property string $create_dt
 *
 * The followings are the available model relations:
 * @property TblCellarWines[] $tblCellarWines
 * @property TblUser $owner
 */
class Cellars extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
	return 'tbl_cellars';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('cellar_name', 'required'),
	    array('owner_id, default_cellar_loc_id', 'numerical', 'integerOnly' => true),
	    array('cellar_name', 'length', 'max' => 45),
	    array('create_dt', 'default',
		'value' => new CDbExpression('NOW()'),
		'setOnEmpty' => false, 'on' => 'insert'),
	    // The following rule is used by search().
	    // @todo Please remove those attributes that should not be searched.
	    array('id, owner_id, cellar_name', 'safe', 'on' => 'search'),
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
	    'cellarLocations' => array(self::HAS_MANY, 'CellarLocation', 'cellar_id'),
	    'cellarWines' => array(self::HAS_MANY, 'CellarWines', 'cellar_id'),
	    'owner' => array(self::BELONGS_TO, 'User', 'owner_id'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
	return array(
	    'id' => 'ID',
	    'owner_id' => 'Owner',
	    'cellar_name' => 'Cellar Name',
	    'default_cellar_loc_id' => 'Default Location',
	    'create_dt' => 'Create Dt',
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
	$criteria->compare('owner_id', $this->owner_id);
	$criteria->compare('cellar_name', $this->cellar_name, true);

	return new CActiveDataProvider($this, array(
	    'criteria' => $criteria,
	));
    }

    /**
     * 
     * @return int
     */
    public function getTotalBottlesInCellar()
    {
	$dbCommand = Yii::app()->db->createCommand(
		"SELECT sum(c.quantity) as totalBottles 
                        FROM tbl_cellar_wines c 
                        WHERE 	c.cellar_id = " . $this->id . ";"
	);

	$qResult = $dbCommand->queryAll();
	if (isset($qResult))
	{
	    $bc = $qResult[0];
	    $tb = (int) $bc['totalBottles'];
	    return $tb;
	}
	else
	{
	    return 0;
	}
    }

    /**
     * 
     * @return array
     */
    public function getWineCountByVarietal()
    {
        $dbCommand = Yii::app()->db->createCommand(
                "SELECT v.name as Varietal, sum(c.quantity) as Count 
                        FROM tbl_varietals v, tbl_wines w, tbl_cellar_wines c 
                        WHERE 	c.cellar_id = " . $this->id . " AND
                		c.wine_id = w.id AND
                		v.id = w.wine_varietal_id
                        GROUP BY v.name
                        ORDER BY v.name;
                ");

        $qResult = $dbCommand->queryAll();

        $countData = NULL;
        $labels = NULL;
        foreach ($qResult as $value)
        {
            $count = (int) $value['Count'];

            $countData[] = $count;
            $labels[] = $value['Varietal'];
        }

        $tabData[0] = $countData;
        $tabData[1] = $labels;

        return $tabData;
    }

    /**
     * 
     * @return array
     */
    public function getWineCountByWinery()
    {
        $dbCommand = Yii::app()->db->createCommand(
                "SELECT n.winery_name as Winery, sum(c.quantity) as Count 
                        FROM tbl_wineries n, tbl_wines w, tbl_cellar_wines c 
                        WHERE 	c.cellar_id = " . $this->id . " AND
                		c.wine_id = w.id AND
                		w.winery_id = n.id
                        GROUP BY n.winery_name
                        ORDER BY n.winery_name;
                ");

        $qResult = $dbCommand->queryAll();

        $countData = NULL;
        $labels = NULL;
        foreach ($qResult as $value)
        {
            $count = (int) $value['Count'];

            $countData[] = $count;
            $labels[] = $value['Winery'];
        }

        $tabData[0] = $countData;
        $tabData[1] = $labels;

        return $tabData;
    }

    /**
     * 
     * @return array
     */
    public function getWineCountByLocation()
    {
        $dbCommand = Yii::app()->db->createCommand(
                "SELECT l.location as Location, sum(c.quantity) as Count 
                        FROM tbl_cellar_wines c, tbl_cellar_location l 
                        WHERE 	c.cellar_id = " . $this->id . "
                          AND   c.cellar_loc_id = l.cellar_loc_id
                        GROUP BY l.location
                        ORDER BY l.location;
                ");

        $qResult = $dbCommand->queryAll();

        $countData = NULL;
        $labels = NULL;
        foreach ($qResult as $value)
        {
            $count = (int) $value['Count'];

            $countData[] = $count;
            $labels[] = $value['Location'];
        }

        $tabData[0] = $countData;
        $tabData[1] = $labels;

        return $tabData;
    }
    
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Cellars the static model class
     */
    public static function model($className = __CLASS__)
    {
	return parent::model($className);
    }
}
