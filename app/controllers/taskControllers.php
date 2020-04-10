<?php


namespace App\Controllers;

use App\Core\App;
use App\Core\Database\queryBuilder;
use App\controllers\htmlOutput;
use App\Models\account;
use App\Models\task;
use App\controllers\helper;
use \Exception;

class taskControllers extends task
{
    public function displayTasks()
    {
        $user = $_SESSION['account'];
        if (isset($_GET['taskId'])) {
            return htmlOutput::viewUserPages('openTask', [
                'tasks' => $this->displayAllTasks($user->userId, helper::isCompleted(), helper::isSearch()),
                'date'=>helper::displayDate()
            ]);
        }
        elseif($_SERVER['REQUEST_URI']=='/today'){
            return htmlOutput::viewUserPages('tasks', [
                'tasks' => $this->selectTodayTask($user->userId, helper::isCompleted(), helper::isSearch(), helper::displayDate()),
                'date' => helper::displayDate()
            ]);
        }
        elseif($_SERVER['REQUEST_URI']=='/allTasks' || helper::isSearch()){
            return htmlOutput::viewUserPages('allTasks',[
                'tasks'=>$this->displayAllTasks($user->userId, helper::isCompleted(),helper::isSearch())
            ]);
        }
        elseif (helper::isCompleted()) {
            return htmlOutput::viewUserPages('finished', [
                'tasks' => $this->displayAllTasks($user->userId, helper::isCompleted(),helper::isSearch())
            ]);
        }
        elseif (helper::sorting()) {
            $this->updateSortingAction();
        }
        else {
            $tasks=$this->displayAllTasks($user->userId, helper::isCompleted(), helper::isSearch());
            foreach ($tasks as $task){
                $data[]=array(
                    'id'=>$task->taskId,
                    'title'=>$task->taskName,
                    'description'=>$task->description,
                    'start'=>$task->date
                );
            }
            echo json_encode($data);
        }
    }

    public function createTasks()
    {
        $user = $_SESSION['account'];
        $taskName = isset($_POST['taskName']) ? $_POST['taskName']:'';
        $priority=isset($_POST['priority'])?$_POST['priority']:'low';
        if (!empty($taskName)) {
            $insert = $this->insertTasks($taskName,$priority, $user->userId, helper::displayDate());
            return htmlOutput::viewUserPages('allTasks',[
                'tasks'=>$this->displayAllTasks($user->userId, helper::isCompleted(),helper::isSearch())
            ]);
        }
        htmlOutput::redirect('');
    }

    public function taskActions()
    {
        if (isset($_POST['description']) && $_POST['action']=='Save') {
            $this->updateTaskAction();
        }
        elseif (isset($_POST['action']) && $_POST['action']=='Delete') {
            $this->deleteTask();
        }
    }

    public function completedTasks()
    {
        if (isset($_POST['taskId']) && isset($_POST['completed'])) {
            if (!empty($_POST['taskId']) && !empty($_POST['completed'])) {
                $updateTasks =$this->updateCompleted([
                    'completed' => $_POST['completed'],
                    'taskId' => $_POST['taskId']
                ]);
                htmlOutput::redirect('finished');
            } else return htmlOutput::redirect('/today');
        }
        else return "ERROR";
    }

    public function updateSortingAction()
    {
        $array = helper::sorting();
        $data = json_decode($array);
        if (!empty($data)) {
            foreach ($data as $item) {
                $parameters = [
                    'sort' => $item->position,
                    'taskId' => $item->id
                ];
                $this->updateSort($parameters);
            }
        }
    }

    public function updateTaskAction(){
        $taskId=isset($_REQUEST['taskId'])?$_REQUEST['taskId']:'';
        if(!empty($taskId) && !empty($_POST['description']) && isset($_POST['description'])){
            $this->updateTasks([
                'description'=>$_POST['description'],
                'taskId'=>$taskId
            ]);
        }
        $this->displayTasks();
    }

    public function deleteTask()
    {
        $taskId = isset($_REQUEST['taskId'])?$_REQUEST['taskId']:'';
        if (!empty($taskId)) {
            $parameters = [
                'taskId' => $taskId
            ];
            $this->delete($parameters);
            return htmlOutput::redirect('today');
        }
    }

}