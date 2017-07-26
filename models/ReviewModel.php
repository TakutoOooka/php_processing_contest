<?php
require_once(dirname(__FILE__) . '/../library/BaseModel.php');
// include(PROJECT_ROOT . '/models/ProductModel.php');

class ReviewModel extends BaseModel
{
    private $parent;

    public function __construct()
    {
        parent::__construct('reviews');
    }

    // public function popular_products()
    // {
    //     $review = new ReviewModel();
    //     $product = new ProductModel();
    // }

    // public function ratings()
    // {
    // }
}
