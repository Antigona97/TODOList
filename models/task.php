<?php


namespace App\Models;

use App\Core\App;
use App\Core\Database\queryBuilder;

class task
{
    public function displayTasks($userId,$completed, $val)
    {
        $parameters = [
            'userId' => $userId,
            'completed'=>$completed,
            'taskName'=>$val
        ];
        return $tasks = App::get('database')->selectData('Select * from tasks where userId=:userId and completed=:completed and taskName like concat("%",:taskName,"%") order by taskId desc', $parameters);
    }

    public function insertTasks($taskName, $user)
    {
        $parameters = [
            'taskName' => $taskName,
            'userId' => $user,
        ];
        return App::get('database')->insert('tasks', $parameters);
    }

    public function updateTasks($parameters)
    {
        return App::get('database')->selectData('Update tasks set description=:description where taskId=:taskId', $parameters);
    }
}