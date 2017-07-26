<?php
require_once(dirname(__FILE__) . '/../library/BaseModel.php');

// include(PROJECT_ROOT . '/models/ReviewModel.php');

class ProductModel extends BaseModel
{
    private $parent;

    public function __construct()
    {
        parent::__construct('products');
    }

    // public function popular_products()
    // {
    //     // $review = new ReviewModel();
    //     // $rating_products =
    // }

    // private function ratings()
    // {
    //     $review = new ReviewModel();
    //     $ret_val = array();

    //     foreach ($review->all() as $r) {
    //         array_push($ret_val, array($r[' '], $r['']));
    //     }
    // }
}
