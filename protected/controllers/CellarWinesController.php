<?php

class CellarWinesController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'create', 'update', 'delete', 'review', 'addBottle', 'removeBottle', 'addWine'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($cellar_id)
    {
        $model = new CellarWines;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $model->cellar_id = $cellar_id;
        if (isset($_POST['CellarWines']))
        {
            $model->attributes = $_POST['CellarWines'];
            if ($model->save())
            {
                // update wine->overall_rating average.
                $current_wine = new Wines();
                $current_wine->refreshRating();

                if ($current_wine->save())
                {
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CellarWines']))
        {
            $model->attributes = $_POST['CellarWines'];
            if ($model->save())
            {
                $this->redirect(array('index', 'cellar_id' => $model->cellar_id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Increment the quantity of a wine in this cellar.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionAddBottle($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $model->increment();
        $model->save();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        Yii::app()->session['cw_return'] = 1;
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index', 'cellar_id' => $model->cellar_id));
    }

    /**
     * Decrement the quantity of wine in this cellar.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionRemoveBottle($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $model->decrement();
        $model->save();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        Yii::app()->session['cw_return'] = 1;
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index', 'cellar_id' => $model->cellar_id));
    }

    /**
     * Decrement the quantity of wine in this cellar.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionReview($wine_id)
    {
        $this->redirect(array('wineComments/index', 'wine_id' => $wine_id));
    }

    /**
     * Add an existing wine into the cellar
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the wine to be added
     */
    public function actionAddWine($wine_id)
    {
        $model = new CellarWines;
        $currentDateTime = new DateTime("now", new DateTimeZone('America/Chicago'));

        if (isset($_POST['CellarWines']))
        {
            $model->attributes = $_POST['CellarWines'];

            $model->cellar_id = Yii::app()->session['cellar_id'];
            $model->wine_id = $wine_id;
            $model->create_dt = $currentDateTime->format('Y-m-d H:i:s');
            $model->update_dt = $currentDateTime->format('Y-m-d H:i:s');

            if ($model->save())
                $this->redirect(array('index', 'cellar_id' => $model->cellar_id));
        }
        else
        {
            $selectedWine = Wines::model()->findByPk($wine_id);

            $model->cellar_id = Yii::app()->session['cellar_id'];
            $model->wine_id = $wine_id;
            $model->quantity = 0;
            $model->rating = $selectedWine->overall_rating;
            $model->cellar_loc_id = 1;
            $model->create_dt = $currentDateTime->format('Y-m-d H:i:s');
            $model->update_dt = $currentDateTime->format('Y-m-d H:i:s');
        }
        

        $this->render('update', array(
            'model' => $model,
        ));

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//        if (!isset($_GET['ajax']))
//        {
//            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('update', 'id' => $model->id));
//        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
        {
            $cellar_id = Yii::app()->session['cellar_id'];
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index', 'cellar_id' => $cellar_id));
        }
    }

    /**
     * Lists wines for the given cellar.
     * @param integer $id is the cellar_id to be listed.
     */
    public function actionIndex($cellar_id)
    {
        $currentCellar = Cellars::model()->findByPk($cellar_id);
        $cellarName = $currentCellar->cellar_name;

        $criteria = new CDbCriteria;
        $criteria->compare('t.cellar_id', $cellar_id, true);
        $criteria->with = array('wine.winery', 'wine.wineVarietal', 'cellarLoc');

        $sort = new CSort();
        $sort->defaultOrder = 'winery.winery_name, wineVarietal.name, wine.wine_year';
        $sort->attributes = array(
            'wine_id' => array(
                'asc' => 'wine_id',
                'desc' => 'wine_id desc',
            ),
            'winery' => array(
                'asc' => 'winery.winery_name',
                'desc' => 'winery.winery_name desc',
            ),
            'varietal' => array(
                'asc' => 'wineVarietal.name',
                'desc' => 'wineVarietal.name desc',
            ),
            'vintage' => array(
                'asc' => 'wine.wine_year',
                'desc' => 'wine.wine_year desc',
            ),
            'wine_name' => array(
                'asc' => 'wine.wine_name',
                'desc' => 'wine.wine_name desc',
            ),
            'quantity' => array(
                'asc' => 'quantity',
                'desc' => 'quantity desc',
            ),
            'rating' => array(
                'asc' => 'rating',
                'desc' => 'rating desc',
            ),
            'location' => array(
                'asc' => 'cellarLoc.location',
                'desc' => 'cellarLoc.location desc',
            ),
        );

        if (!isset($_REQUEST['CellarWines_page']))
        {
            if (isset(Yii::app()->session['cw_return']))
            {
                $gridpage = Yii::app()->session['cw_gridpage'];
                unset(Yii::app()->session['cw_return']);
            }
            else
            {
                $gridpage = 0;
            }
        }
        else
        {
            $gridpage = $_REQUEST['CellarWines_page'] - 1;
        }

        Yii::app()->session['cw_gridpage'] = $gridpage;

        $dataProvider = new CActiveDataProvider('CellarWines', array(
            'criteria' => $criteria,
            'sort' => $sort,
            'pagination' => array(
                'pageSize' => 18,
                'currentPage' => $gridpage,
            ),
        ));

        $model = new CellarWines('search');
        $model->unsetAttributes();  // clear any default values
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'cellarName' => $cellarName,
            'cellar_id' => $cellar_id,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new CellarWines('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['CellarWines']))
            $model->attributes = $_GET['CellarWines'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return CellarWines the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = CellarWines::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CellarWines $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cellar-wines-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
