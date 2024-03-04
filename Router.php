<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function checkRoutes()
    {

        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }


        if ( $fn ) {
            // Call user fn calls a function when we don't know wich one is
            call_user_func($fn, $this); // $this is to pass arguments
        } else {
            echo "Page not found";
        }
    }

    public function render($view, $data = [])
    {
        // Read what we pass to the view
        foreach ($data as $key => $value) {
            $$key = $value;
        }

        ob_start(); // Temporary memory storage

        // include the view
        include_once __DIR__ . "/views/$view.php";
        $content = ob_get_clean(); // Clean buffer and get what was on it
        include_once __DIR__ . '/views/layout.php';
    }
}
