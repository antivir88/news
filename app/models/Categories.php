<?php

namespace App\Models;

use Micro\Db\ConnectionInjector;
use Micro\Mvc\Models\Model;
use Micro\Mvc\Models\Query;
use Micro\Mvc\Models\Relations;

class Categories extends Model
{
    public static $tableName = 'categories';


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Sub-Category',
            'name' => 'Name'
        ];
    }

    public function rules()
    {
        return [
            ['name', 'required'],
            ['id,category', 'number'],
            ['name', 'string', 'max' => 127]
        ];
    }

    public function relations()
    {
        $relations = new Relations;

        $relations->add('parent', '\App\Models\Categories', false, ['category', 'id']);
        $relations->add('news', '\App\Models\News', true, ['id', 'user']);

        return $relations;
    }

    public function getCategories()
    {
        $db = (new ConnectionInjector)->build();

        $query = new Query($db);
        $query->select = $db->getDriverType() === 'pgsql' ? '"id" as "value", "name" as "text"' : '`id` as `value`, `name` as `text`';
        $query->table = $db->getDriverType() === 'pgsql' ? '"'.self::$tableName.'"': '`'.self::$tableName.'`';

        return $query->run(\PDO::FETCH_ASSOC);
    }
}