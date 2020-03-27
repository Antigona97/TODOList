<?php


namespace App\Controllers;

use App\Core\App;
use App\Core\Database\queryBuilder;
use App\controllers\htmlOutput;
use App\Models\account;
use App\Models\task;
use \Exception;

if(isset($_POST['class']) && !empty($_POST['class'])){
    $class=$_POST['class'];
    switch ($class){
        case 'updatePriorityAction' : taskControllers::updateProrityAction();  break;
    }
}

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
        if(isset($_POST['taskId'])) {
            $updateTasks = App::get('database')->update('tasks', [
                'completed' => '1'
            ]);
            htmlOutput::redirect('');
        } else {
            return htmlOutput::redirect('/today');
        }
    }

    public function displayTasksAction()
    {
        $user = $_SESSION['account'];
        $tasks = $this->displayTasks($user->userId,0,$this->isSearch());
        if(isset($_GET['task'])){
            return htmlOutput::view('openTask',[
                'tasks'=>$tasks
            ]);
        }
        if($this->isSearch()){
            return htmlOutput::view('tasks',[
                'tasks'=>$tasks
            ]);
        }
        if($this->priority()){
            $this->updatePriorityAction();
        }
        return htmlOutput::view('tasks', [
            'tasks' => $tasks
        ]);
    }

    public function updatePriorityAction(){
        $array=$this->priority();
            $parameters=[
                'priority'=>$array['position'],
                'taskId'=>$array['id']
            ];
           $this->updatePriority($parameters);
    }

    public function priority(){
        return isset($_POST['arrayPosition'])?$_POST['arrayPosition']:'';
    }

    public function isSearch(){
        return isset($_GET['searchTask'])?$_GET['searchTask']:'';
    }

}