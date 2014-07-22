<?php

class DefaultController extends FrApiBaseController
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            array(
                'ext.freshRest.FrAuthFilter -authenticate -index'
            )
        );
    }

    /**
     * Default action - in most cases returns please login or redirects to documentation
     */
    public function actionIndex()
    {
        $this->renderOutput("MySommelier");
    }

    public function actionAuthenticate()
    {
        $data = $this->getData();
        if (isset($data['secret']))
        {
            $model = $this->module->getAuthModel();
            if ($model->authenticate($data['secret']))
            {
				Yii::log('API Access Authenticated ID=' . $model->api_id, Clogger::LEVEL_INFO,'application.api.event');
                // return temporary auth token and exit
                $this->renderOutput(array('token' => $model->token));
            }
            // wrong password provided
			Yii::log('API Access Denide ID=' . $model->api_id, Clogger::LEVEL_INFO,'application.api.event');
            $this->renderError('403', 'Wrong password provided.');
        }

        // wrong format
        $this->renderError('403', 'Wrong format, probably missing secret key.');
    }
}