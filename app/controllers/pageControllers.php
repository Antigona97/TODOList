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
        return $this->view('tasks');
    }

    public function thisweek(){
        return $this->view('thisweek');
    }

    public function changeProfile(){
        return $this->view('profile');
    }

    public function openTask(){
        return $this->view('openTask');
    }
}