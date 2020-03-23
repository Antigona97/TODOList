<?php
namespace App\Models;

use App\Core\Database\queryBuilder;
use App\Core\App;

class account
{
    public function validate($input, $post){
        $rules = [
            'email' => [
                'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$#',
                'message' => 'Email is not valid',
            ],
            'username' => [
                'pattern' => '#^[a-z0-9]{3,15}$#',
                'message' => 'Please control your username',
            ],
            'password' => [
                'pattern' => '#^[a-z0-9]{8,30}$#',
                'message' => 'Password must be at least 8 characters, contains number',

            ],
        ];
        foreach ($input as $val) {
            if (!isset($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val])) {
                $this->error = $rules[$val]['message'];
                return false;
            }
        }
        return true;
    }

    public  function checkIfEmailExists($email){
        $parameters=[
            'email'=>$email
        ];
        return App::get('database')->selectData("Select * from users where email=:email", $parameters);
    }

    public function checkData($username, $password){
        $parameters=[
            'username'=>$username
        ];
        $hash=App::get('database')->selectData("Select * from users where username=:username", $parameters);
        if(!password_verify($password, $hash['password'])){
            return $hash['password'];
        } return true;
    }

    public function login($username){
        $parameters=[
            'username'=>$username
        ];
        $data=App::get('database')->selectData("Select * from users where username=:username", $parameters);
        $_SESSION['account']=$data[0];
    }

    public function register($email, $username, $password){
        $passwordHash=password_hash($password, PASSWORD_BCRYPT, array("cost"=>12));
        $hash=substr($passwordHash,0,60);
        $parameters=[
            'email'=>$email,
            'username'=>$username,
            'password'=>$hash,
            'confirmPassword'=>$hash
        ];
        $data=App::get('database')->insert('users', $parameters);
    }
}