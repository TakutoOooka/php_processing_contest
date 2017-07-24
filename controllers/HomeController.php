<?php

class HomeController
{
    private $params;
    private $controller;

    public function __construct($params)
    {
        $this->controller = 'home';
        $this->params = $params;
    }

    public function index()
    {
        $this->render_view('index');
    }

    public function not_found_action_method()
    {
        // show html
        $this->render_view('not_found_action_method');
    }

    private function render_view($action)
    {
        $controller = $this->controller;
        include(PROJECT_ROOT . '/views/application.php');
    }
}
