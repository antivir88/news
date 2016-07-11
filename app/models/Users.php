<?php

namespace App\Models;

use Micro\Db\ConnectionInjector;
use Micro\Mvc\Models\Model;
use Micro\Mvc\Models\Query;
use Micro\Mvc\Models\Relations;

class Users extends Model
{
    public static $tableName = 'users';


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password'
        ];
    }

    public function rules()
    {
        return [
            ['login, password', 'required'],
            ['login', 'string', 'min' => 6, 'max' => 127],
            ['password', 'string', 'min' => 32, 'max' => 32]
        ];
    }

    public function relations()
    {
        $relations = new Relations;

        $relations->add('news', '\App\Models\News', true, ['id', 'user']);

        return $relations;
    }

    public function getUsers()
    {
        $db = (new ConnectionInjector)->build();

        $query = new Query($db);
        $query->select = $db->getDriverType() === 'pgsql' ? '"id" as "value", "login" as "text"' : '`id` as `value`, `login` as `text`';
        $query->table = $db->getDriverType() === 'pgsql' ? '"'.self::$tableName.'"': '`'.self::$tableName.'`';

        return $query->run(\PDO::FETCH_ASSOC);
    }
}