<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="container" id="page">

            <div id="header">
                <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
            </div><!-- header -->

            <div id="mainMbMenu">
                <?php
                    $this->widget('application.extensions.mbmenu.MbMenu', array(
                        'items' => array(
                            array('label' => 'Home', 'url' => array('/site/index')),
                            array('label' => 'My Cellars', 'url' => array('/cellars/index'), 
				'visible' => ((Yii::app()->user->getState('isSiteAdmin') === TRUE) ||
						 (Yii::app()->user->getState('isCellarAdmin') === TRUE) ||
						 (Yii::app()->user->getState('isCellarUser') === TRUE))
			    ),
                            array('label' => 'Reference Data', 'items' => array(
                                    array('label' => 'Manage Wine Details', 'url' => array('/wines/index')),
                                    array('label' => 'Manage Regions', 'url' => array('/regions/admin')),
                                    array('label' => 'Manage Appellations', 'url' => array('/appellations/admin')),
                                    array('label' => 'Manage Varietals', 'url' => array('/varietals/admin')),
                                    array('label' => 'Manage Wineries', 'url' => array('/wineries/index')),
                                ), 
				'visible' => ((Yii::app()->user->getState('isSiteAdmin') === TRUE) ||
						 (Yii::app()->user->getState('isCellarAdmin') === TRUE))
                            ),
                            array('label' => 'Site Admin', 'items' => array(
                                    array('label' => 'Manage Users', 'url' => array('/user/admin')),
                                    array('label' => 'Manage API Access', 'url' => array('/apiAccess/index')),
                                    array('label' => 'System Configuration', 'url' => array('/systemconfig/index')),
                                ), 'visible' => (Yii::app()->user->getState('isSiteAdmin') === TRUE)
                            ),
                            array('label' => 'Contact', 'url' => array('/site/contact')),
                            array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                            array('label' => 'Register', 'url' => array('/user/register'), 'visible' => Yii::app()->user->isGuest),
                            array('label' => 'Profile (' . Yii::app()->user->name . ')', 'url' => array('/profile/view', 'id' => Yii::app()->user->id), 'visible' => !Yii::app()->user->isGuest),
                            array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                            array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                        ),
                    ));
                ?>
            </div><!-- mainMbMenu -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                    ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

            <div class="clear"></div>

            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> by Jim Kreth.<br/>
                All Rights Reserved.<br/>
            <?php echo Yii::powered(); ?>
            </div><!-- footer -->
        </div><!-- page -->
    </body>
</html>
