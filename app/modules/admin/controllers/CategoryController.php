<?php

namespace App\Modules\Admin\Controllers;

use App\Models\Categories;
use App\Modules\Admin\Components\AdminController;
use Micro\Db\ConnectionInjector;
use Micro\Mvc\Models\Query;
use Micro\Mvc\Views\PhpView;
use Micro\Web\FlashInjector;
use Micro\Web\FlashMessage;
use Micro\Web\RequestInjector;

class CategoryController extends AdminController
{
    public function actionIndex()
    {
        $query = new Query((new ConnectionInjector)->build()->getDriver());
        $query->objectName = '\App\Models\Categories';

        $view = new PhpView;
        $view->addParameter('query', $query);
        $view->addParameter('page', (new RequestInjector)->build()->query('list', FILTER_VALIDATE_INT, ['options' => ['default' => 0]]));

        return $view;
    }
    public function actionCreate()
    {
        $model = new Categories;
        $data = (new RequestInjector)->build()->post('Categories', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        if ($data) {
            if (empty($data['category'])) {
                unset($data['category']);
            }

            $model->setModelData($data);

            if ($model->save(true)) {
                $this->redirect('/admin/category/' . $model->id)->send();
                exit;
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
            $this->redirect('/admin/category')->send();
            exit;
        }

        $v = new PhpView;
        $v->addParameter('model', Categories::findByPk($id));

        return $v;
    }
    public function actionUpdate()
    {
        $id = (new RequestInjector)->build()->query('id', FILTER_VALIDATE_INT, ['options'=>['default'=>0]]);
        if (!$id) {
            $this->redirect('/admin/category')->send();
            exit;
        }

        $model = Categories::findByPk($id);
        $data = (new RequestInjector)->build()->post('Categories', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        if ($data) {
            $model->setModelData($data);

            if ($model->save(true)) {
                $this->redirect('/admin/category/' . $model->id);
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
            $this->redirect('/admin/category')->send();
            exit;
        }

        if (Categories::findByPk($id)->delete()) {
            (new FlashInjector)->build()->push(FlashMessage::TYPE_SUCCESS, 'Category `'.(int)$id.'` has been updated');
        }

        $this->redirect('/admin/category')->send();

        exit;
    }
}