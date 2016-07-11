<?php

namespace App\Modules\Admin\Forms;

use App\Models\Users;
use Micro\Db\ConnectionInjector;
use Micro\Form\FormModel;
use Micro\Mvc\Models\Query;
use Micro\Web\SessionInjector;

class LoginFormModel extends FormModel
{
    public $login;
    public $password;


    public function attributeLabels()
    {
        return [
            'login' => 'Login',
            'password' => 'Password'
        ];
    }

    public function rules()
    {
        return [
            // Web security
            ['login, password', 'trim'],
            ['login, password', 'strip_tags'],
            ['login, password', 'htmlspecialchars'],

            // check value elements
            ['login', 'string', 'min' => 3, 'max' => 16],
            ['password', 'string', 'min' => 3, 'max' => 32]
        ];
    }

    public function logined()
    {
        $query = new Query((new ConnectionInjector)->build());
        $query->addWhere('m.login = :login');
        $query->addWhere('m.password = :password');

        $query->params = [
            ':login' => $this->login,
            ':password' => md5($this->password)
        ];

        $user = Users::finder($query, true);

        if ($user) {
            $session = (new SessionInjector)->build();
            $session->UserID = $user->id;

            return true;
        } else {
            $this->addError('Wrong login or password.');

            return false;
        }
    }
}