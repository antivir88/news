<?php

namespace App\Controllers;

use App\Components\Controller;
use App\Models\News;
use Micro\Db\ConnectionInjector;
use Micro\Mvc\Models\Query;
use Micro\Mvc\Views\PhpView;
use Micro\Web\RequestInjector;
use Micro\Web\UserInjector;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $page = (new RequestInjector)->build()->query('list', FILTER_VALIDATE_INT, ['options' => ['default' => 0]]);

        $sql = new Query((new ConnectionInjector)->build()->getDriver());
        $sql->objectName = '\App\Models\News';
        $sql->table = News::$tableName;
        $sql->order = 'created_at DESC';

        $view = new PhpView;
        $view->addParameter('sql', $sql);
        $view->addParameter('page', $page);

        return $view;
    }

    public function actionError()
    {
        $view = new PhpView;
        $view->data = 'Error - ' . $_POST['error']->getMessage();

        return $view;
    }
}