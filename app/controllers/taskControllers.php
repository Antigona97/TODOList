<?php

namespace App\Controllers;

session_start();

use App\Core\App;
use App\Core\Database\queryBuilder;
use App\controllers\htmlOutput;
use App\Models\account;
use App\Models\task;
use \Exception;

class taskControllers extends task
{
    public $view;
    public function insertTasks(){
        $description=isset($_POST['description'])?$_POST['description']:'';
        if($description==''){
            htmlOutput::redirect('');
        }
        else  {
            $insertTask=App::get('database')->insert('tasks',[
                'description'=>$description
            ]);
        }
    }

    public function completedTasks(){
        if(isset($_GET['completed'])) {
            $updateTasks = App::get('database')->update('tasks', [
                'completed' => '1'
            ]);
            htmlOutput::redirect('');
        } else {
            return htmlOutput::redirect('/today');
        }
    }

    public function display(){
        $userId=$_SESSION['account'];
        if ($this->isSearch()) {
            $val = $this->isSearch();
            return $this->displayTasks($userId);
        }
        $tasks = $this->displayTasks($userId);
        return htmlOutput::view('tasks',[
            'tasks'=>$tasks
        ]);
    }

    public function isSearch(){
        return isset($_GET['searchTask'])?$_GET['searchTask']:'';
    }

    public function format($tasks){
        return htmlOutput::output($tasks);
    }
}