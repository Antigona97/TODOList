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
    public function events(){
        $user=$_SESSION['account'];
        $tasks=$this->displayAllTasks($user->userId, helper::isCompleted());
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

    public function createEvent(){
        $user = $_SESSION['account'];
        $taskName = isset($_POST['taskName']) ? $_POST['taskName']:'';
        $priority=isset($_POST['priority'])?$_POST['priority']:'low';
        $date=isset($_POST['date'])?$_POST['date']:'2020-04-23';
        if (!empty($taskName) && !empty($date)) {
            $this->insertTasks($taskName,$priority, $user->userId, $date);
            var_dump(date("Y-m-d", strtotime($date)));
            //$this->events();
        }
        htmlOutput::redirect('');
    }

    public function tasks(){
        $user=$_SESSION['account'];
        if (helper::isCompleted()) {
            return htmlOutput::viewUserPages('finished', [
                'tasks' => $this->displayAllTasks($user->userId, helper::isCompleted())
            ]);
        }
        return htmlOutput::viewUserPages('allTasks',[
            'tasks'=>$this->displayAllTasks($user->userId, helper::isCompleted())
        ]);
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

    public function createTasks()
    {
        $user = $_SESSION['account'];
        $taskName = isset($_POST['taskName']) ? $_POST['taskName']:'';
        $priority=isset($_POST['priority'])?$_POST['priority']:'low';
        if (!empty($taskName)) {
            $insert = $this->insertTasks($taskName,$priority, $user->userId, $this->displayDate());
            $this->displayTasksAction();
        }
        htmlOutput::redirect('');
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

    public function displayTasksAction()
    {
        $user = $_SESSION['account'];
        $tasks = $this->displayTasks($user->userId, helper::isCompleted(), helper::isSearch(), $this->displayDate());
        if (isset($_GET['taskId'])) {
            return htmlOutput::viewUserPages('openTask', [
                'tasks' => $this->displayAllTasks($user->userId, helper::isCompleted()),
                'date'=>$this->displayDate()
            ]);
        }
        elseif (helper::sorting()) {
            $this->updateSortingAction();
        }
        else return htmlOutput::viewUserPages('tasks', [
            'tasks' => $tasks,
            'date' => $this->displayDate()
        ]);
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

    public function weekTasks()
    {
        $user = $_SESSION['account'];
        $tasks = $this->displayTasks($user->userId, helper::isCompleted(), helper::isSearch(), $this->displayDate());
        if(isset($_GET['taskId'])){
            return htmlOutput::viewUserPages('openTask', [
                'tasks' => $tasks,
                'date' => $this->displayDate()
            ]);
        }
        return htmlOutput::viewUserPages('thisweek', [
            'tasks' => $tasks,
            'date' => $this->displayDate()
        ]);
    }

    public function updateTaskAction(){
        $taskId=isset($_REQUEST['taskId'])?$_REQUEST['taskId']:'';
        if(!empty($taskId) && !empty($_POST['description']) && isset($_POST['description'])){
            $this->updateTasks([
                'description'=>$_POST['description'],
                'taskId'=>$taskId
            ]);
        }
        $this->displayTasksAction();
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

    public function displayDate()
    {
        $date = isset($_POST['inputDate']) ? $_POST['inputDate'] : date("Y-m-d");
        return date("Y-m-d", strtotime($date));
    }
}