<?php

namespace App\Modules\Admin\Controllers;

use App\Models\Comments;
use App\Modules\Admin\Components\AdminController;
use Micro\Db\ConnectionInjector;
use Micro\Mvc\Models\Query;
use Micro\Mvc\Views\PhpView;
use Micro\Web\FlashInjector;
use Micro\Web\FlashMessage;
use Micro\Web\RequestInjector;

class CommentsController extends AdminController
{
    public function actionIndex()
    {
        $query = new Query((new ConnectionInjector)->build()->getDriver());
        $query->objectName = '\App\Models\Comments';

        $view = new PhpView;
        $view->addParameter('query', $query);
        $view->addParameter('page', (new RequestInjector)->build()->query('list', FILTER_VALIDATE_INT, ['options' => ['default' => 0]]));

        return $view;
    }
    public function actionCreate()
    {
        $model = new Comments;
        $data = (new RequestInjector)->build()->post('Comments', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        if ($data) {
            $model->setModelData($data);

            if ($model->save(true)) {
                $this->redirect('/admin/comments/' . $model->id);
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
            $this->redirect('/admin/comments')->send();
            exit;
        }

        $v = new PhpView;
        $v->addParameter('model', Comments::findByPk($id));

        return $v;
    }
    public function actionUpdate()
    {
        $id = (new RequestInjector)->build()->query('id', FILTER_VALIDATE_INT, ['options'=>['default'=>0]]);
        if (!$id) {
            $this->redirect('/admin/comments')->send();
            exit;
        }

        $model = Comments::findByPk($id);

        if (!$model) {
            $this->redirect('/admin/comments')->send();
            exit;
        }

        $data = (new RequestInjector)->build()->post('Comments', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        if ($data) {
            $model->setModelData($data);

            if ($model->save(true)) {
                $this->redirect('/admin/comments/' . $model->id);
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
            $this->redirect('/admin/comments')->send();
            exit;
        }

        if (Comments::findByPk($id)->delete()) {
            (new FlashInjector)->build()->push(FlashMessage::TYPE_SUCCESS, 'Comments `'.(int)$id.'` has been updated');
        }

        $this->redirect('/admin/comments')->send();

        exit;
    }
}