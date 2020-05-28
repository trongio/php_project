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
        $poster_name=getCurrentUser();

        if($_FILES["post_image"]["tmp_name"]!=false) {
            $maxid = $input->get_max_id(). ".png";
            $filepath = "images/" . $maxid;
            if (move_uploaded_file($_FILES["post_image"]["tmp_name"], $filepath)) {
                $temp = true;
            }
        }

        if(empty($errors)){
            $input->post($data['post_title'], $data['post_text'],$poster_name['full_name'],date("Y-m-d h:i:sa"),$maxid);
//            return $router->renderView('home', $params);
            header("Location: http://localhost:8080/");
        } else return $router->renderView('post', $params);
    }
}