<?php
include(PROJECT_ROOT . '/library/BaseController.php');
class HomeController extends BaseController
{
    public function __construct($params)
    {
        parent::__construct($params);
        $this->controller = 'home';
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
}
