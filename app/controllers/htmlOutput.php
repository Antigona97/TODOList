<?php


namespace App\controllers;

class htmlOutput
{
    public function redirect($uri){
        header("Location:/".$uri);
        exit;
    }

    public function view($name, $parameters=[]){

        extract((array)$parameters);

        return require "app/views/$name.view.php";
    }

    public function error($path,$field,$error){
        header("Location:$path?field=$field&message=$error");
    }
}