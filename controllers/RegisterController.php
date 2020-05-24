<?php


namespace app\controllers;


use app\db\Database;
use app\IRequest;
use app\Router;

class RegisterController
{
    public function register(IRequest $request, Router $router)
    {
        $data = $request->getBody();
        $errors=[];
        $input=new database();
        $email_used=$input->get_email($data['email']);
        $name_used=$input->get_full_name($data['full_name']);

        if(!$data['full_name']) {
            $errors['full_name'] = "required field";
        }
        if($name_used){
            $errors['full_name'] = "name already in use";
        }
        if(!$data['email']) {
            $errors['email'] = "required field";
        }
        if($email_used){
            $errors['email'] = "email already in use";
        }
        if(!$data['password'])
            $errors['password'] = "required field";

        $params = [
                    'errors' => $errors,
                    'data' => $data
                ];

        copy('../views/PersonalPageTemplate.php','../views/'.$data['full_name'].'.php');

        if(empty($errors)){
            $input->register($data['full_name'], $data['email'], password_hash($data['password'], PASSWORD_BCRYPT), date("Y-m-d h:i:sa"));
            return $router->renderView('login', $params);
        } else return $router->renderView('register', $params);
    }

}