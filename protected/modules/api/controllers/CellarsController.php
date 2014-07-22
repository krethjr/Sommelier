<?php

class CellarsController extends FrApiBaseController
{

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            // only list and view actions are allowed
            'disabled +update,create,delete',
            array(
                // authenticate except simple "version" action
                'ext.freshRest.FrAuthFilter -apiVersion'
            )
        );
    }

    /**
     * Public action
     */
    public function actionApiVersion()
    {
        $pong = "cellars api, version: 1.0";
        $this->renderOutput($pong);
    }

    /**
     * Default view all wineries
     */
    public function actionIndex()
    {
        $cellarList = Wines::model()->findAll();
        $this->renderOutput($wineList);
    }

    /**
     * Default view all wineries
     */
    public function actionView($id)
    {
        $wineList = Wines::model()->findByPk($id);
        $this->renderOutput($wineList);
    }

    /**
     * Default view all wineries
     */
    public function actionUpdate($id)
    {
        $wineList = Wines::model()->findByPk($id);
        $this->renderOutput($wineList);
    }

    /**
     * Default view all wineries
     */
    public function actionDelete($id)
    {
        $wineList = Wines::model()->findByPk($id);
        $this->renderOutput($wineList);
    }

    /**
     * Default view all wineries
     */
    public function actionCreate()
    {
        $wineList = Wines::model()->findByPk($id);
        $this->renderOutput($wineList);
    }

    /**
     * List only 5 recently updated items
     */
    public function actionRecent()
    {
        $apiModel = $this->getApiResource('recent');
        $models = $apiModel->findAll();
        $output = array();
        foreach ($models as $model)
        {
            $output[] = $model->getApiOutput();
        }
        $this->renderOutput($output);
    }
}