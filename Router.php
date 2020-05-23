<?php
namespace app;

use app\db\Database;
use \app\IRequest;

class Router
{
    protected $request = null;
    public $database = null;
    protected $routes = [];
    protected $postRoutes = [];
    public $layout = '_layout';

    public function __construct(IRequest $request, Database $database)
    {
        $this->request = $request;
        $this->database = $database;
    }

    public function get($path, $closure)
    {
        $this->routes[$path] = $closure;
    }

    public function post($path, $closure)
    {
        $this->postRoutes[$path] = $closure;
    }

    public function resolve()
    {
        $path = $this->request->getPath() ?? '/';
        $method = strtolower($this->request->getMethod());
        if ($method === 'get') {
            $closureOrView = $this->routes[$path] ?? false;
        } else {
            $closureOrView = $this->postRoutes[$path] ?? false;
        }
        if ($closureOrView) {
            if (is_string($closureOrView)){
                echo $this->renderView($closureOrView);
            } else {
                echo call_user_func($closureOrView, $this->request, $this);
            }
        } else {
            header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
            echo "Not Found";
            exit;
        }
    }

    public function renderView($view, $params = [])
    {
        $content = $this->renderOnlyView($view, $params); // <h1>Home page</h1>
        ob_start();
        include_once __DIR__ . "/views/{$this->layout}.php";
        return ob_get_clean();
    }

    public function renderOnlyView($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        /**
         * 111<h1>Home page</h1>
         */
        ob_start();
        if(is_array($view) or $view == '/') $view = '/home';
        include_once __DIR__ . '/views/'.$view.'.php';
        return ob_get_clean(); /**  */
    }

    public function __destruct()
    {
        $this->resolve();
    }
}