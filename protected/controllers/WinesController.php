<?php

class WinesController extends Controller
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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('admin', 'index', 'view', 'create', 'update', 'delete', 'picker'),
                'users' => array('@'),
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
    public function actionCreate()
    {
        if (!$this->allowRole('SITE_ADMIN, CELLAR_ADMIN, CELLAR_USER'))
        {
            throw new CHttpException(403, 'You do not have permisssion');
        }
        
        $model = new Wines;

        if (Yii::app()->session['from_cellar'] == '1')
        {
            $cellar_id = Yii::app()->session['cellar_id'];
            $currentCellar = Cellars::model()->findByPk($cellar_id);
            $cellarName = $currentCellar->cellar_name;
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Wines']))
        {
            $model->attributes = $_POST['Wines'];
            $model->image = CUploadedFile::getInstance($model, 'image');
            
            if ($model->validate())
            {
                if (!empty($model->image))
                {
                    $rnd = rand(0, 99999999);
                    $fileName = "label_image_" . str_pad((string) $rnd, 8, "0", STR_PAD_LEFT) . ".jpg";
                    $model->image->saveAs(Yii::app()->basePath . "/../images/labels/" . $fileName);
                    $model->image_file = $fileName;
                }
                else
                {
                    $model->image_file = Yii::app()->params['defaultImageFile'];
                }

                if ($model->save())
                {
                    if (Yii::app()->session['from_cellar'] == '1')
                    {
                        $this->redirect(array('cellarWines/addWine', 'wine_id' => $model->id));
                    }
                    else
                    {
                        $this->redirect(array('index'));
                    }
                }
            }
        }

        if (Yii::app()->session['from_cellar'] == '1')
        {
            $this->render('create', array(
                'model' => $model,
                'cellar_id' => $cellar_id,
                'cellarName' => $cellarName,
            ));
        }
        else
        {
            $this->render('create', array(
                'model' => $model,
            ));
        }
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

        if (isset($_POST['Wines']))
        {
            $model->attributes = $_POST['Wines'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        try
        {
            $this->loadModel($id)->delete();
        }
        catch (CDbException $e)
        {
            Yii::app()->user->setFlash('error', "The Wine could not be deleted.");
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $criteria = new CDbCriteria;
        $criteria->with = array('winery', 'wineVarietal', 'appellation');

        $sort = new CSort();
        $sort->defaultOrder = 'winery.winery_name, wineVarietal.name, wine_year';
        $sort->attributes = array(
            'id' => array(
                'asc' => 't.id',
                'desc' => 't.id desc',
            ),
            'winery' => array(
                'asc' => 'winery.winery_name',
                'desc' => 'winery.winery_name desc',
            ),
            'wine_name' => array(
                'asc' => 't.wine_name',
                'desc' => 't.wine_name desc',
            ),
            'varietal' => array(
                'asc' => 'wineVarietal.name',
                'desc' => 'wineVarietal.name desc',
            ),
            'wine_year' => array(
                'asc' => 't.wine_year',
                'desc' => 't.wine_year desc',
            ),
            'appellation' => array(
                'asc' => 'appellation.appellation',
                'desc' => 'appellation.appellation desc',
            ),
            'overall_rating' => array(
                'asc' => 't.overall_rating',
                'desc' => 't.overall_rating desc',
            ),
        );

        $dataProvider = new CActiveDataProvider('Wines', array(
            'criteria' => $criteria,
            'sort' => $sort,
            'pagination' => array(
                'pageSize' => 20),
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionPicker($cellar_id)
    {
        $currentCellar = Cellars::model()->findByPk($cellar_id);
        $cellarName = $currentCellar->cellar_name;

        $criteria = new CDbCriteria;
        $criteria->with = array('winery', 'wineVarietal', 'appellation');

        $sort = new CSort();
        $sort->defaultOrder = 'winery.winery_name, wineVarietal.name, wine_year';
        $sort->attributes = array(
            'id' => array(
                'asc' => 't.id',
                'desc' => 't.id desc',
            ),
            'winery' => array(
                'asc' => 'winery.winery_name',
                'desc' => 'winery.winery_name desc',
            ),
            'wine_name' => array(
                'asc' => 't.wine_name',
                'desc' => 't.wine_name desc',
            ),
            'varietal' => array(
                'asc' => 'wineVarietal.name',
                'desc' => 'wineVarietal.name desc',
            ),
            'wine_year' => array(
                'asc' => 't.wine_year',
                'desc' => 't.wine_year desc',
            ),
            'appellation' => array(
                'asc' => 'appellation.appellation',
                'desc' => 'appellation.appellation desc',
            ),
            'overall_rating' => array(
                'asc' => 'overall_rating',
                'desc' => 'overall_rating desc',
            ),
        );

        $dataProvider = new CActiveDataProvider('Wines', array(
            'criteria' => $criteria,
            'sort' => $sort,
            'pagination' => array(
                'pageSize' => 20),
        ));

        $this->render('picker', array(
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
        $model = new Wines('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Wines']))
            $model->attributes = $_GET['Wines'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Wines the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Wines::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Wines $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'wines-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
