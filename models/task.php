<?php


namespace App\Models;

use App\Core\App;
use App\Core\Database\queryBuilder;

class task
{
    public function selectTodayTask($userId,$completed, $val, $date)
    {
        $parameters = [
            'userId' => $userId,
            'completed'=>$completed,
            'taskName'=>$val,
            'date'=>$date
        ];
        return $tasks = App::get('database')->selectData('Select * from tasks where userId=:userId and completed=:completed and date=:date and taskName like concat("%",:taskName,"%") order by sort', $parameters);
    }

    public function displayAllTasks($userId, $completed, $val){
        $parameters=[
            'userId'=>$userId,
            'completed'=>$completed,
            'taskName'=>$val
        ];
        return App::get('database')->selectData('Select * from tasks where userId=:userId and completed=:completed and taskName like concat("%",:taskName,"%") order by sort', $parameters);
    }

    public function insertTasks($taskName,$priority, $user, $date)
    {
        $parameters = [
            'taskName' => $taskName,
            'priority'=>$priority,
            'userId' => $user,
            'date'=>$date
        ];
        return App::get('database')->insert('tasks', $parameters);
    }

    public function updateCompleted($parameters){
        return App::get('database')->selectData('Update tasks set completed=:completed where taskId=:taskId', $parameters);
    }

    public function updateTasks($parameters)
    {
        return App::get('database')->selectData('Update tasks set description=:description where taskId=:taskId', $parameters);
    }

    public function updateTaskName($parameters){
        return App::get('database')->selectData('Update tasks set taskName=:taskName where taskId=:taskId', $parameters);
    }

    public function updateSort($parameters){
        return App::get('database')->selectData('Update tasks set sort=:sort where taskId=:taskId', $parameters);
    }

    public function delete($parameters){
        return App::get('database')->selectData('Delete from tasks where taskId=:taskId',$parameters);
    }
}