<?php
class ProductController
{
    private $params;
    private $controller = 'product';
    function __construct($params)
    {
        require_once(PROJECT_ROOT . '/models/ProductModel.php');
        session_start();
        $this->params = $params;
    }

    public function index()
    {
        $this->render_view('review', 'index');
    }

    public function show()
    {
        $product = new ProductModel();
        $this->params['show_product'] = $product->find_by('id', $this->params['id']);
        $this->render_view('product', 'show');
    }

    public function new_action()
    {
        $this->render_view('product', 'new_action');
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
        $new_product['user_id'] = $_SESSION['user_id'];
        $new_product['product_name'] = $product_name;
        rename(PROJECT_ROOT . "/images/". $_SESSION["user_id"] . "_user_id.png", PROJECT_ROOT . "/images/" . $new_product["id"] . ".png");
        $new_product['image_url'] = $new_product['id'] . '.png';
        $new_product['source_code'] = $source_code;
        $product->save($new_product);
        $this->render_view('product', 'create');
    }

    function edit()
    {
        $product = new ProductModel();
        $this->params['edit_data'] = $product->find_by('id', $this->params['id']);
        $this->render_view('product', 'edit');
    }

    function update()
    {
        $this->render_view('product', 'update');
    }

    function receive_pic()
    {
        $this->params;
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

    private function render_view($controller, $action)
    {
        $params = $this->params;
        include(PROJECT_ROOT . '/views/application.php');
    }
}
