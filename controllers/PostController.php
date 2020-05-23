<?php


namespace app\controllers;


use app\db\Database;
use app\IRequest;
use app\Router;

class PostController
{
    public function post(IRequest $request, Router $router)
    {
        $data = $request->getBody();
        $errors=[];
        $input=new database();

        if(!$data['post_title'])
            $errors['post_title'] = "required field";
        if(!$data['post_text'])
            $errors['post_text'] = "required field";

        $params = [
            'errors' => $errors,
            'data' => $data
        ];

        if(empty($errors)){
            $input->post($data['post_title'], $data['post_text'],"????",date("Y-m-d h:i:sa"),$data['post_image']);
        } else return $router->renderView('register', $params);
    }
}