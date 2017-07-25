<?php
include(PROJECT_ROOT . '/library/BaseController.php');
include(PROJECT_ROOT . '/models/ProductModel.php');
include(PROJECT_ROOT . '/models/ReviewModel.php');

class HomeController extends BaseController
{
    public function __construct($params)
    {
        parent::__construct($params);
        $this->controller = 'home';
    }

    public function index()
    {
        $product = new ProductModel();
        $product->all();
        $product->order_desc('updated_at');
        $this->params['new_products'] = $product->limit(12);
        // // $reviews =
        // $this->params['popular_products'] = 1;
        $this->render_view('index');
    }

    public function not_found_action_method()
    {
        // show html
        $this->render_view('not_found_action_method');
    }
}
