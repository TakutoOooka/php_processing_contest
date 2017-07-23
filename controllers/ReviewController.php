<?php
class ReviewController
{
    private $params;

    public function __construct($params)
    {
        session_start();
        $this->params = $params;
    }
    function index()
    {
        $this->render_view('review', 'index');
    }

    function show()
    {
        $this->render_view('review', 'show');
    }

    function new_action()
    {
        $this->render_view('review', 'new_action');
    }

    function create()
    {
        $this->render_view('review', 'create');
    }

    function edit()
    {
        $this->render_view('review', 'edit');
    }

    function update()
    {
        $this->render_view('review', 'update');
    }

    function delete()
    {
        $this->render_view('review', 'delete');
    }

    private function render_view($controller, $action)
    {
        $params = $this->params;
        include(PROJECT_ROOT . '/views/application.php');
    }
}
