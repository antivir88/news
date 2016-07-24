<?php

namespace App\Modules\Admin\Controllers;

use App\Models\News;
use App\Modules\Admin\Components\AdminController;
use Micro\Db\ConnectionInjector;
use Micro\Mvc\Views\PhpView;
use Micro\Web\FlashInjector;
use Micro\Web\FlashMessage;
use Micro\Web\RequestInjector;
use Micro\Mvc\Models\Query;

class NewsController extends AdminController
{
    public function actionIndex()
    {
        $query = new Query((new ConnectionInjector)->build()->getDriver());
        $query->objectName = '\App\Models\News';

        $view = new PhpView;
        $view->addParameter('query', $query);
        $view->addParameter('page', (new RequestInjector)->build()->query('list', FILTER_VALIDATE_INT, ['options' => ['default' => 0]]));

        return $view;
    }
    public function actionCreate()
    {
        $model = new News;
        $data = (new RequestInjector)->build()->post('News', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        if ($data) {
            $model->setModelData($data);

            if ($model->save(true)) {
                $this->redirect('/admin/news/' . $model->id);
            }
        }

        $v = new PhpView;
        $v->addParameter('model', $model);

        return $v;
    }
    public function actionRead()
    {
        $id = (new RequestInjector)->build()->query('id', FILTER_VALIDATE_INT, ['options'=>['default'=>0]]);
        if (!$id) {
            $this->redirect('/admin/news')->send();
            exit;
        }

        $v = new PhpView;
        $v->addParameter('model', News::findByPk($id));

        return $v;
    }
    public function actionUpdate()
    {
        $id = (new RequestInjector)->build()->query('id', FILTER_VALIDATE_INT, ['options'=>['default'=>0]]);
        if (!$id) {
            $this->redirect('/admin/news')->send();
            exit;
        }

        $model = News::findByPk($id);
        $data = (new RequestInjector)->build()->post('News', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        if ($data) {
            $model->setModelData($data);

            if ($model->save(true)) {
                $this->redirect('/admin/news/' . $model->id)->send();
                exit;
            }
        }

        $v = new PhpView;
        $v->addParameter('model', $model);

        return $v;
    }
    public function actionDelete()
    {
        $id = (new RequestInjector)->build()->query('id', FILTER_VALIDATE_INT, ['options'=>['default'=>0]]);

        if (!$id) {
            $this->redirect('/admin/news')->send();
            exit;
        }

        if (News::findByPk($id)->delete()) {
            (new FlashInjector)->build()->push(FlashMessage::TYPE_SUCCESS, 'News `'.(int)$id.'` has been updated');
        }

        $this->redirect('/admin/news')->send();

        exit;
    }
}