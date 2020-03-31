<?php


namespace App\Controllers;

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
            $insert=$this->insertTasks($taskName, $user->userId, $this->displayDate());
            $tasks=$this->displayTasksAction();
            return htmlOutput::view('tasks', [
                'tasks'=>$tasks
            ]);
        } htmlOutput::redirect('');
    }

    public function updateTaskAction(){
        $user=$_SESSION['account'];
        $task=$this->displayTasks($user->userId,0, $this->isSearch(), $this->priority());
        $taskId=isset($_GET['taskId'])?$_GET['taskId']:'';
        $description=isset($_POST['description'])?$_POST['description']:'';
        if(!empty($taskId)){
                $this->updateTasks([
                    'description'=>$description,
                    'taskId'=>$taskId
                ]);
            $this->displayTasksAction();
        }
    }

    public function completedTasks(){
        if(isset($_POST['taskId']) && isset($_POST['completed'])) {
            if(!empty($_POST['taskId']) && !empty($_POST['completed'])){
                $updateTasks = $this->updateCompleted([
                    'completed' => $_POST['completed'],
                    'taskId'=>$_POST['taskId']
                ]);
                htmlOutput::redirect('');
            }  else return htmlOutput::redirect('/today');
        }
    }

    public function displayTasksAction()
    {
        $user = $_SESSION['account'];
        $tasks = $this->displayTasks($user->userId,$this->isCompleted(),$this->isSearch());
        $date=$this->displayDate();
        if(isset($_GET['task'])){
            return htmlOutput::view('openTask',[
                'tasks'=>$tasks,
                'date'=>$date
            ]);
        }
        if($this->isSearch()){
            return htmlOutput::view('tasks',[
                'tasks'=>$tasks,
                'date'=>$date
            ]);
        }
        if($this->priority()){
            $this->updatePriorityAction();
        }
        if($this->isCompleted()){
            return htmlOutput::view('finished',[
                'tasks'=>$tasks,
                'date'=>$date
            ]);
        }
        return htmlOutput::view('tasks', [
            'tasks' => $tasks,
            'date'=>$date
        ]);
    }

    public function updatePriorityAction(){
        $array=$this->priority();
        $data=json_decode($array);
        if(!empty($data)){
            foreach ($data as $item){
                $parameters=[
                    'priority'=>$item->position,
                    'taskId'=>$item->id
                ];
                var_dump($parameters);
                $this->updatePriority($parameters);
            }
        }
    }

    public function priority(){
        return isset($_POST['arrayPosition'])?$_POST['arrayPosition']:'';
    }

    public function isSearch(){
        return isset($_GET['searchTask'])?$_GET['searchTask']:'';
    }

    public function isCompleted(){
        return isset($_GET['completed'])?$_GET['completed']:0;
    }

    public function displayDate(){
        return isset($_POST['date'])?$_POST['date']:date("Y-m-d");
    }

}