<?php
namespace App\Controllers;

use App\Core\App;
use App\Core\Database\queryBuilder;
use App\controllers\htmlOutput;
use \Exception;

class taskControllers extends htmlOutput
{
    public $tasks;
    public $view;
    public function insertTasks(){
        $description=isset($_POST['description'])?$_POST['description']:'';
        if($description==''){
            $this->redirect('');
        }
        else  {
            $tasks=App::get('database')->insert('tasks',[
                'description'=>$description
            ]);
        }
    }

    public function completedTasks(){
        if(isset($_GET['completed'])) {
            $tasks = App::get('database')->update('tasks', [
                'completed' => '1'
            ]);
            $this->redirect('');
        } else {
            return $this->redirect('/today');
        }
    }

    public function displayTasks(){
        if($this->isSearch()) {
            $val = $this->isSearch();
            $query = "Select * from tasks where description like %$val%";

            $tasks = App::get('database')->selectData($query,['']);
            return $this->format($tasks);
        }
        $tasks=App::get('database')->selectData("Select * from tasks", ['']);
    }

    public function isSearch(){
        return isset($_GET['searchTask'])?$_GET['searchTask']:'';
    }

    public function format($tasks){
        return $this->output($tasks);
    }
}