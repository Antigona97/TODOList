<?php


namespace App\controllers;


class helper
{
    public function sorting()
    {
        return isset($_POST['arrayPosition']) ? $_POST['arrayPosition'] : '';
    }

    public function isSearch()
    {
        return isset($_GET['searchTask']) ? $_GET['searchTask'] : '';
    }

    public function isCompleted()
    {
        return isset($_GET['completed']) ? $_GET['completed'] : 0;
    }

}