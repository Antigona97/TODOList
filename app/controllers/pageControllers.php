<?php


namespace App\Controllers;

use App\Core\App;
use App\controllers\htmlOutput;
use \Exception;

class pageControllers extends htmlOutput
{
    public function home()
    {
        return $this->view('login');
    }

    public function register(){
        return $this->view('register');
    }

    public function todayTasks()
    {
        return $this->viewUserPages('tasks');
    }


    public function changeProfile(){
        return $this->view('profile');
    }

    public function openTask(){
        return $this->viewUserPages('openTask');
    }

    public function finished(){
        return $this->viewUserPages('finished');
    }

    public function alltasks(){
        return $this->viewUserPages('allTasks');
    }

    public function calendar(){
        return $this->viewUserPages('calendar');
    }
}