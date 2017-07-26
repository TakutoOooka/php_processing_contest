<?php
include(PROJECT_ROOT . '/library/BaseController.php');
include(PROJECT_ROOT . '/models/ProductModel.php');
include(PROJECT_ROOT . '/models/ReviewModel.php');

class ProductController extends BaseController
{
    function __construct($params)
    {
        parent::__construct($params);
        $this->controller = 'product';
        require_once(PROJECT_ROOT . '/models/ProductModel.php');
    }

    public function index()
    {
        $product = new ProductModel();
        $this->params['all_products'] = $product->all();
        $this->render_view('index');
    }

    public function show()
    {
        $product = new ProductModel();
        $this->params['show_product'] = $product->find_by('id', $this->params['id']);

        $review = new ReviewModel();
        $this->params['reviews'] = $review->select('product_id == ' . $this->params['show_product']['id']);
        $this->render_view('show');
    }

    public function new_action()
    {
        $this->render_view('new_action');
    }

    function create()
    {
        $source_code = $this->params['source_code'];
        if (isset($this->params['product_name'])) {
            $product_name = $this->params['product_name'];
        } else {
            $product_name = 'none';
        }
        $product = new ProductModel();
        $new_product = $product->new_record();
        $new_product['user_id'] = $_COOKIE['user_id'];
        $new_product['product_name'] = $product_name;
        rename(PROJECT_ROOT . "/images/". $_COOKIE["user_id"] . "_user_id.png", PROJECT_ROOT . "/images/" . $new_product["id"] . ".png");
        $new_product['image_url'] = $new_product['id'] . '.png';
        $new_product['source_code'] = $source_code;
        $product->save($new_product);
        $this->render_view('create');
    }

    function edit()
    {
        $product = new ProductModel();
        $this->params['edit_data'] = $product->find_by('id', $this->params['id']);
        $this->render_view('edit');
    }

    function update()
    {
        $source_code = $this->params['source_code'];
        if (isset($this->params['product_name'])) {
            $product_name = $this->params['product_name'];
        } else {
            $product_name = 'none';
        }
        $product = new ProductModel();
        $edit_product = $product->find_by('id', $this->params['id']);
        $edit_product['product_name'] = $product_name;
        // ajaxで送られてきていた一時的な仮画像ファイルの名前を規則に則って変更
        rename(PROJECT_ROOT . "/images/". $_COOKIE["user_id"] . "_user_id.png", PROJECT_ROOT . "/images/" . $edit_product["id"] . ".png");
        $edit_product['source_code'] = $source_code;
        $product->save($edit_product);
        $this->render_view('update');
    }

    // ajaxで送られてくる画像ファイルを受け取り保存するためのメソッド
    function receive_pic()
    {
        if (is_uploaded_file($_FILES["acceptImage"]["tmp_name"])) {
            $filename = $this->params['id'] . '_user_id.png';
            if (move_uploaded_file($_FILES["acceptImage"]["tmp_name"], PROJECT_ROOT . '/images/' . $filename)) {
                        echo "アップロードしました。<br>";
                    echo $_FILES["acceptImage"]["tmp_name"];
            } else {
                        echo "ファイルをアップロードできません。";
            }
        } else {
                  echo "ファイルが選択されていません。";
        }
    }

    function show_my_products()
    {
        $product = new ProductModel();
        $product->select('user_id == ' . $_COOKIE['user_id']);
        $this->params['my_products'] = $product->order_desc('updated_at');
        $this->render_view('show_my_products');
    }
}
