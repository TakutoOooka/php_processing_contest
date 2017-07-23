<?php
require_once(dirname(__FILE__) . '/../library/BaseModel.php');
class ProductModel extends BaseModel
{
    private $parent;

    public function __construct()
    {
        parent::__construct('products');
    }
}
