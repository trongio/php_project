<?php

namespace app\controllers;

use app\IRequest;
use app\Router;
use GuzzleHttp\Client;

class JsonPlaceholderController
{
    public function users(IRequest $request, Router $router)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/users');

        $headers = getallheaders();
        echo '<pre>';
        var_dump($headers);
        echo '</pre>';
        exit;
        $contentType = $headers['Content-Type'] ?? false;
        if ($contentType === 'application/json') {
            $content = "send json";
        } else {
            $content = "send XML";
        }
        header('Content-Type: '.$contentType);
        return $content;
    }

    public function posts(IRequest $request, Router $router)
    {
        $client = new Client();
        $userId = $request->getBody()['userId'] ?? null;
        if (!$userId){
            return $router->renderView('404');
        }
        $response = $client->request('GET', "https://jsonplaceholder.typicode.com/users/$userId/posts");
        $posts = json_decode($response->getBody(), true);
        return $router->renderView('posts');
    }
}