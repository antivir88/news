<?php

namespace App\Modules\Admin\Controllers;

use App\Components\Controller;
use App\Modules\Admin\Forms\LoginFormModel;
use Micro\Base\KernelInjector;
use Micro\Form\FormBuilder;
use Micro\Mvc\Views\PhpView;
use Micro\Web\RequestInjector;
use Micro\Web\SessionInjector;
use Micro\Web\UserInjector;

class DefaultController extends Controller
{
    public function filters()
    {
        return [
            [
                'class' => '\Micro\Filter\AccessFilter',
                'actions' => ['login', 'logout', 'index'],
                'rules' => [
                    [
                        'allow' => false,
                        'actions' => ['index'],
                        'users' => ['?'],
                        'message' => 'Authorized only'
                    ],
                    [
                        'allow' => false,
                        'actions' => ['login'],
                        'users' => ['@'],
                        'message' => 'Not authorized only'
                    ],
                    [
                        'allow' => false,
                        'actions' => ['logout'],
                        'users' => ['?'],
                        'message' => 'Authorized only'
                    ]
                ]
            ],
            [
                'class' => '\Micro\Filter\XssFilter',
                'actions' => ['index', 'login', 'logout'],
                'clean' => '*'
            ]
        ];
    }
    public function actionIndex()
    {
        return new PhpView;
    }
    public function actionLogin()
    {
        /** @noinspection PhpIncludeInspection */
        $form = new FormBuilder(
            include (new KernelInjector)->build()->getAppDir() . '/modules/admin/views/default/loginform.php',
            new LoginFormModel,
            'POST'
        );

        if ($post = (new RequestInjector)->build()->post('LoginFormModel', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY)) {
            $form->setModelData($post);

            /** @noinspection PhpUndefinedMethodInspection */
            if ($form->validateModel() && $form->getModel()->logined()) {
                $this->redirect('/admin')->send();
                exit;
            }
        }

        $v = new PhpView;
        $v->addParameter('form', $form);

        return $v;
    }
    public function actionLogout()
    {
        (new SessionInjector())->build()->destroy();
        $this->redirect('/')->send();
        exit;
    }
}