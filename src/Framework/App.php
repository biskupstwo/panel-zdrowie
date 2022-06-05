<?php
namespace Framework\App;
require __DIR__ . '/../index.php';
require __DIR__ . '/Globals.php';
require __DIR__ . '/Database.php';
require PROJECT_ROOT . '/Controller/Controller.php';

class App
{
    /**
     * @param array List of routes.
     */
    protected array $route_list;

    public function __construct()
    {
        $this->route_list = [];
    }
    /**
     * Parse uri and return array.
     * @return array Parsed array from url.
     */
    public function parse_uri(string $uri): array
    {
        $uri_array = explode('/', $uri);
        if (strstr($uri, '/')) {
            array_shift($uri_array);
        }
        return $uri_array;
    }

    /**
     * Add route to list of routes.
     * @param $routePath Path of the route.
     * @param $callback Callback of the route to call when matched.
     * @return void
     */
    public function add_route(string $routePath, $callback)
    {
        if (isset($this->route_list[$routePath])) {
            throw new \ErrorException('Route already exists');
        }
        $this->route_list[$routePath] = [
            'route' => $this->parse_uri($routePath),
            'callback' => $callback
        ];
    }

    /**
     * Main function to run and match urls.
     */
    public function run()
    {
        $parsed_uri = $this->parse_uri(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        foreach ($this->route_list as $route) {
            if ($route['route'] === $parsed_uri) {
                if (is_array($route['callback'])) {
                    [$class, $method] = $route['callback'];
                    $controller = new $class();
                    call_user_func( [ $controller, $method ] );
                    return;
                } else {
                    $route['callback']();
                    return;
                }
                continue;
            }
            $route_param = null;
            $match = false;
            foreach ($route['route'] as $index => $route_key) {
                if (count($route['route']) !== count($parsed_uri)) {
                    continue;
                }
                if (preg_match('/^{[A-Za-z0-9_]{2,}}$/', $route_key)) {
                    global $route_param;
                    if (!isset($parsed_uri[$index]) || !is_numeric($parsed_uri[$index])) {
                        break;
                    }
                    $route_param = $parsed_uri[$index];
                    $match = true;
                    continue;
                }
                if ($route_key !== $parsed_uri[$index]) {
                    global $match;
                }
            }
            if ($match) {
                if (is_array($route['callback'])) {
                    [$class, $method] = $route['callback'];
                    $controller = new $class();
                    call_user_func_array( [ $controller, $method ], [$route_param] );
                    return;
                } else {
                    $route['callback']($route_param);
                    return;
                }
            } 
        }
        view('404')();
    }
}
