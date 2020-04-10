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

    public function displayDate()
    {
        $date = isset($_POST['inputDate']) ? $_POST['inputDate'] : date("Y-m-d");
        return date("Y-m-d", strtotime($date));
    }

}