<?php


namespace App\controllers;
use App\controllers\ItasksInterface;

class htmlOutput implements ItasksInterface
{

    public function output($tasks)
    {?>
        <form method="post" action="/completed" >
            <div>
                <?php
                if(is_array($tasks) || is_object($tasks)) {
                    foreach ($tasks as $task) :?>
                        <h4><i class="fa fa-circle">
                            <?=$task['description']?>
                            </i>
                        </h4>
                <?php endforeach; }?>
            </div>
        </form> <?php
    }

    public function redirect($uri){
        header("Location:/".$uri);
        exit;
    }

    public function view($name){
        return require "app/views/$name.view.php";
    }

    public function error($path,$field,$error){
        header("Location:$path?field=$field&message=$error");
    }
}