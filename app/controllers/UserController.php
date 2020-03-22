<?php


namespace App\Controllers;

use App\controllers\htmlOutput;
use App\Models\account;

class userController extends account
{

    public function loginAction(){
        $username=isset($_POST['username'])?$_POST['username']:'';
        $password=isset($_POST['password'])?$_POST['password']:'';

        if(!empty($_POST) && !empty($username) && !empty($password)){
            if(!($this->validate(['username', 'password'], $_POST))){
                return htmlOutput::error("/",'username','Username is not valid');
            }
            elseif (!$this->checkData($username, $password)){
                return htmlOutput::error("/", 'password', 'Password is not valid');
            }
            $this->login($username);
            htmlOutput::redirect('today');
        }
        htmlOutput::redirect('');
    }

    public function registerAction(){

        $email=isset($_POST['email'])?$_POST['email']:'';
        $username=isset($_POST['username'])?$_POST['username']:'';
        $password=isset($_POST['password'])?$_POST['password']:'';
        $cpassword=isset($_POST['cpassword'])?$_POST['cpassword']:'';

        if(!empty($_POST) && !empty($email) && !empty($username) && !empty($password) && !empty($cpassword)){
            if(!$this->validate(['email', 'username', 'password'], $_POST)){
                 return htmlOutput::error("/register", 'button', $this->error);
            }
            elseif ($this->checkIfEmailExists($email)){
                return htmlOutput::error("/register", 'email', 'This email exists');
            }
            else {
                $this->register($email, $username, $password);
                htmlOutput::redirect('');
            }
        }
    }

    public function profileAction(){

        $username=isset($_POST['username'])?$_POST['username']:'';
        $email=isset($_POST['email'])?$_POST['email']:'';
        $currentPassword=isset($_POST['currentPassword'])?$_POST['currentPassword']:'';
        $newPassword=isset($_POST['newPassword'])?$_POST['newPassword']:'';
        $confirmPassword=isset($_POST['confirmPassword'])?$_POST['confirmPassword']:'';

        if(!empty($_POST)){
            if(!$this->validate(['username','email','password'], $_POST)){
                return htmlOutput::error("/profile", 'username', $this->error);
            }
            elseif(!$this->checkIfEmailExists($email)){
                return htmlOutput::error('/profile','email', 'This email does not exists');
            }
            elseif($this->checkData($username, $currentPassword)){
                return htmlOutput::error("/profile",'currentPassword', 'Password is not valid');
            }
            else {
                $this->save($username, $email, $newPassword, $confirmPassword);
            }
        }
    }
}