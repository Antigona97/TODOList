<?php
   return [
       'database'=>[
           'name' => 'todolist',
           'username' => 'root',
           'password' => '',
           'connection' => 'mysql:host=localhost',
           'options' => [
               PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
           ]
       ]
   ];