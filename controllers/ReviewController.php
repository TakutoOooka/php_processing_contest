<?php
class ReviewController
{
    private $params;
    private $controller;

    public function __construct($params)
    {
        $this->controller = 'review';
        $this->params = $params;
    }
    function index()
    {
        $this->render_view('index');
    }

    function show()
    {
        $this->render_view('show');
    }

    function new_action()
    {
        $this->render_view('new_action');
    }

    function create()
    {
        $this->render_view('create');
    }

    function edit()
    {
        $this->render_view('edit');
    }

    function update()
    {
        $this->render_view('update');
    }

    function delete()
    {
        $this->render_view('delete');
    }

    private function render_view($controller, $action)
    {
        $params = $this->params;
        $controller = $this->controller;
        include(PROJECT_ROOT . '/views/application.php');
    }
}
