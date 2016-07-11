<?php

namespace App\Controllers;

use App\Components\Controller;
use App\Models\News;
use Micro\Mvc\Views\PhpView;
use Micro\Web\RequestInjector;

class NewsController extends Controller
{
    public function actionIndex()
    {
        $slug = (new RequestInjector)->build()->query('slug');
        if (!$slug) {
            $this->redirect('/')->send();
            exit;
        }

        $news = News::findByAttributes(['slug' => $slug], true);
        if (!$news) {
            $this->redirect('/')->send();
            exit;
        }

        $view = new PhpView;
        $view->addParameter('model', $news);

        return $view;
    }
}