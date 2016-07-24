<?php

namespace App\Models;

use Micro\Db\ConnectionInjector;
use Micro\Mvc\Models\Model;
use Micro\Mvc\Models\Query;
use Micro\Mvc\Models\Relations;

class News extends Model
{
    public static $tableName = 'news';


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'User',
            'category' => 'Category',
            'slug' => 'Slug',
            'name' => 'Name',
            'announce' => 'Announce',
            'content' => 'Content',
            'created_at' => 'Date create'
        ];
    }

    public function rules()
    {
        return [
            ['user,category,slug,name,announce,content', 'required'],
            ['id,user,category', 'number'],
            ['slug,name', 'string', 'max' => 127],
            ['announce', 'string', 'max' => 255]
        ];
    }

    public function relations()
    {
        $relations = new Relations;

        $relations->add('catalog', '\App\Models\Categories', false, ['category', 'id']);
        $relations->add('creator', '\App\Models\Users', false, ['user', 'id']);

        return $relations;
    }

    public function getNews()
    {
        $db = (new ConnectionInjector)->build()->getDriver();

        $query = new Query($db);
        $query->select = $db->getDriverType() === 'pgsql' ? '"id" as "value", "name" as "text"' : '`id` as `value`, `name` as `text`';
        $query->table = $db->getDriverType() === 'pgsql' ? '"'.self::$tableName.'"': '`'.self::$tableName.'`';

        return $query->run(\PDO::FETCH_ASSOC);
    }
}