<?php

class CellarsController extends Controller
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
            array('allow', // allow authenticated user to perform 'create', 'update' and 'delete' actions
                'actions' => array('index', 'view', 'summary', 'create', 'update', 'delete', 'admin'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    private function createDefaultCellarLoc($cellar_id)
    {
        $newCellarLoc = new CellarLocation();
        $newCellarLoc->cellar_id = $cellar_id;
        $newCellarLoc->location = "Other";
        $newCellarLoc->location_desc = "Location not assigned";

        $newCellarLoc->save();
        return ($newCellarLoc->cellar_loc_id);
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionSummary($cellar_id)
    {
	$currentCellar = $this->loadModel($cellar_id);
        $totalBottles = $currentCellar->getTotalBottlesInCellar($cellar_id);
        $tabData_v = $currentCellar->getWineCountByVarietal($cellar_id);
        $tabData_w = $currentCellar->getWineCountByWinery($cellar_id);
        $tabData_l = $currentCellar->getWineCountByLocation($cellar_id);

        $this->render('summary', array(
            'model' => $this->loadModel($cellar_id),
            'dataArrayV' => $tabData_v[0],
            'xLabelsV' => $tabData_v[1],
            'dataArrayW' => $tabData_w[0],
            'xLabelsW' => $tabData_w[1],
            'dataArrayL' => $tabData_l[0],
            'xLabelsL' => $tabData_l[1],
            'totalBottles' => $totalBottles,
        ));
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
        $model = new Cellars;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Cellars']))
        {
            $model->attributes = $_POST['Cellars'];
            $model->owner_id = Yii::app()->user->id;
            if ($model->save())
            {
                $model->default_cellar_loc_id = $this->createDefaultCellarLoc($model->id);
                if ($model->save())
				{
					Yii::log('Cellar Create ID=' . $model->id, Clogger::LEVEL_INFO,'application.cellar.event');
					$this->redirect(array('index'));
				}
            }
        }

        $this->render('create', array(
            'model' => $model,
            'owner_id' => Yii::app()->user->id,
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

        if (isset($_POST['Cellars']))
        {
            $model->attributes = $_POST['Cellars'];
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
		Yii::log('Cellar Destroyed ID=' . $id, Clogger::LEVEL_INFO,'application.cellar.event');
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $criteria = new CDbCriteria;

        //if not admin, restrict cellars to current user's cellars
        if (Yii::app()->user->name != 'admin')
            $criteria->compare('owner_id', Yii::app()->user->id, true);

        $dataProvider = new CActiveDataProvider('Cellars', array(
            'criteria' => $criteria
        ));

        unset(Yii::app()->session['cellar_id']);

        //if the user only has one cellar, skip directly to view, bypassing index
        if ($dataProvider->itemCount === 1)
        {
            $dataArray = $dataProvider->getData();
            foreach ($dataArray as $data)
            {
                $id = $data->id;
            }
            $this->redirect(array('view', 'id' => $id));
        }
        else
        {
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Cellars('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Cellars']))
            $model->attributes = $_GET['Cellars'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Cellars the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Cellars::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Cellars $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cellars-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
