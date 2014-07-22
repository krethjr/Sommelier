<?php

class WineriesController extends FrApiBaseController
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
        $pong = "wineries api, version: 1.0";
        $this->renderOutput($pong);
    }

    /**
     * Default view all wineries
     */
    public function actionIndex()
    {
        $wineryList = Wineries::model()->findAll();
        $this->renderOutput($wineryList);
    }

    /**
     * Default view all wineries
     */
    public function actionView($id)
    {
        $wineryList = Wineries::model()->findByPk($id);
        $this->renderOutput($wineryList);
    }

    /**
     * Default view all wineries
     */
    public function actionUpdate($id)
    {
        $wineryList = Wineries::model()->findByPk($id);
        $this->renderOutput($wineryList);
    }

    /**
     * Default view all wineries
     */
    public function actionDelete($id)
    {
        $wineryList = Wineries::model()->findByPk($id);
        $this->renderOutput($wineryList);
    }

    /**
     * Default view all wineries
     */
    public function actionCreate()
    {
        $wineryList = Wineries::model()->findByPk($id);
        $this->renderOutput($wineryList);
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