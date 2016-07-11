<?php

namespace App\Models;

use Micro\Mvc\Models\Model;
use Micro\Mvc\Models\Relations;

class Comments extends Model
{
    public static $tableName = 'comments';


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'E-mail',
            'text' => 'Text',
            'news_id' => 'News'
        ];
    }

    public function relations()
    {
        $relations = new Relations;

        $relations->add('news', '\App\Models\News', false, ['news_id', 'id']);

        return $relations;
    }
}