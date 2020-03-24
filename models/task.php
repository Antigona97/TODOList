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

    public function insertTasks($taskName, $user){
        $parameters=[
            'taskName'=>$taskName,
            'userId'=>$user,
        ];
        return App::get('database')->insert('tasks', $parameters );
    }

    public function updateTasks($parameters){
        return App::get('database')->selectData('Update tasks set $ where taskName=:taskName', $parameters);
    }
}