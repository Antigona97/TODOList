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
    public function createTasks(){
        $user=$_SESSION['account'];
        $taskName=isset($_POST['taskName'])?$_POST['taskName']:'';
        if(!empty($taskName)){
            $insert=$this->insertTasks($taskName, $user->userId);
            $tasks=$this->displayTasksAction();
            return htmlOutput::view('tasks', [
                'tasks'=>$tasks
            ]);
        } htmlOutput::redirect('');
    }

    public function updateTaskAction(){
        $taskName=isset($_GET['taskName'])?$_GET['taskName']:'';
        $description=isset($_POST['description'])?$_POST['description']:'';
        if($_POST['description']){
            if(!empty($description) && !empty($taskName)){
                $this->updateTasks([
                    'description'=>$description,
                    'taskName'=>$taskName
                ]);
            }  return htmlOutput::view('tasks');
        } elseif ($_POST['editTask']){

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

    public function displayTasksAction(){
        $user=$_SESSION['account'];
        $tasks = $this->displayTasks($user->userId);
        return htmlOutput::view('tasks', [
            'tasks'=>$tasks
        ]);
    }

    public function isSearch(){
        return isset($_GET['searchTask'])?$_GET['searchTask']:'';
    }
}