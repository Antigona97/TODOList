<?php


namespace App\Models;

use App\Core\App;
use App\Core\Database\queryBuilder;

abstract class task
{
    public $tasks;
    public function __construct(){
        $this->tasks;
    }
    public function displayTasks($userId){
        $parameters=[
            'userId'=>$userId
        ];
        $this->tasks=App::get('database')->selectData('Select * from tasks where userId=:userId', $parameters);
    }

}