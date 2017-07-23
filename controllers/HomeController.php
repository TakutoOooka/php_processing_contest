<?php

class HomeController
{
    private $params;

    public function __construct($params)
    {
        session_start();
        $this->params = $params;
    }

    public function index($params)
    {
        $this->render_view('home', 'index');
    }

    public function not_found_action_method($params)
    {
        // show html
        $this->render_view('home', 'not_found_action_method');
    }

    private function render_view($controller, $action)
    {
        include(PROJECT_ROOT . '/views/application.php');
    }
}
