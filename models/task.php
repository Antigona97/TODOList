<?php


namespace App\Models;

use App\Core\App;
use App\Core\Database\queryBuilder;

class task
{
    public function displayTasks($userId){
        $parameters=[
            'userId'=>$userId
        ];
        return App::get('database')->selectData('Select * from tasks where userId=:userId', $parameters);
    }
}