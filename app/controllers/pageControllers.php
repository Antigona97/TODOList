<?php


namespace App\Controllers;

use App\Core\App;
use App\controllers\htmlOutput;
use \Exception;

class pageControllers extends htmlOutput
{
    public function home()
    {
        return htmlOutput::view('login');
    }

    public function register(){
        return htmlOutput::view('register');
    }

    public function todayTasks()
    {
        return htmlOutput::view('tasks');
    }

    public function thisweek(){
        return htmlOutput::view('thisweek');
    }

    public function changeProfile(){
        return htmlOutput::view('profile');
    }

}