<?php
include(PROJECT_ROOT . '/library/BaseController.php');
class ReviewController extends BaseController
{
    public function __construct($params)
    {
        parent::__construct($params);
        $this->controller = 'review';
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
}
