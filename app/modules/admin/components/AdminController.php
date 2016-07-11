<?php

namespace App\Modules\Admin\Components;

use App\Components\Controller;
use Micro\Web\UserInjector;

class AdminController extends Controller
{
    public $permission = 'admin-panel';

    /**
     * AdminController constructor.
     * @param string $modules
     * @throws \Exception
     */
    public function __construct($modules = '')
    {
        parent::__construct($modules);

        $user = (new UserInjector)->build();

        if ($user->isGuest() || !$user->check($this->permission)) {
            $this->redirect('/admin/login')->send();
            exit;
        }
    }
}