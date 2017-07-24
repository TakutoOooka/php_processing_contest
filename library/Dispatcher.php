<?php

class Dispatcher
{
    private $params;

    private $routings = array(
        /* root controller actions */
        array('GET', '', 'home#index'),
        /* home controller actions */
        array('GET', 'home', 'home#index'),
        /* user controller actions */
        array('GET',    'user',          'user#index'),
        array('GET',    'user/_id',      'user#show'),
        array('GET',    'user/new',      'user#new_action'),
        array('POST',   'user',          'user#create'),
        array('GET',    'user/_id/edit', 'user#edit'),
        array('POST',    'user/_id/update',      'user#update'),
        array('GET', 'user/_id/delete',      'user#delete'),
        /* user controller actions(sessions) */
        array('GET',       'user/sign_in',    'user#sign_in'),
        array('POST',       'user/signed_in',  'user#signed_in'),
        array('GET',       'user/signed_out', 'user#signed_out'),
        /* product controller actions */
        array('GET',    'product',          'product#index'),
        array('GET',    'product/_id',      'product#show'),
        array('GET',    'product/new',      'product#new_action'),
        array('POST',   'product',          'product#create'),
        array('GET',    'product/_id/edit', 'product#edit'),
        array('POST',    'product/_id/update',      'product#update'),
        array('GET', 'product/_id/delete',      'product#delete'),
        array('GET', 'product/show_my_products', 'product#show_my_products'),
        /* sending processing screen shot for ajax */
        array('POST',    'product/receive_pic',          'product#receive_pic'),
        /* review controller actions */
        array('GET',    'review',            'review#index'),
        array('GET',    'review/_id',        'review#show'),
        array('GET',    'review/new',        'review#new_action'),
        array('POST',   'review',            'review#create'),
        array('GET',    'review/_id/edit',   'review#edit'),
        array('POST',    'review/_id/update',        'review#update'),
        array('GET', 'review/_id/delete',        'review#delete')
    );

    /*
    $routing_schemaの中身
    array(
     array(
      'http_method' => 'GET',
      'route' => 'home',
      'action' => 'home#index'
     ),
     array(
     ),
     ...........
    );

    */

    private $routing_schema = array();

    public function __construct()
    {
        try {
            $this->params = $this->get_http_params();
        } catch (Exception $e) {
            echo $e->getMessage() . '\n';
        }

        $this->arange_routings();
    }

    private function arange_routings()
    {
        $tmep_v = array();
        foreach ($this->routings as $route) {
            $temp_v['http_method'] = $route[0];
            $temp_v['route'] = $route[1];
            $temp_v['action'] = $route[2];
            array_push($this->routing_schema, $temp_v);
        }
    }

    private function get_http_params()
    {
        $param = array();
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $param = $_GET;
                break;
            case 'POST':
                $param = $_POST;
                break;
            case 'PUT':
            case 'DELETE':
            default:
                parse_str(file_get_contents('php://input'), $param);
                break;
        }
        return $param;
    }

    public function dispatch()
    {
        if (!$this->check_routing()) {
            $this->execute_controller_action('home', 'error_404');
        }
    }

    private function check_routing()
    {
        $success = false;

        foreach ($this->routing_schema as $route) {
            if ($route['http_method'] == $_SERVER['REQUEST_METHOD']) {
                // 'user/_id'と'user/3'を/で分割しその配列に対して全て比較をする
                $schema_routes = explode('/', $route['route']);
                if (isset($this->params['route'])) {
                    $url_routes = explode('/', $this->params['route']);
                } else {
                    $url_routes = array('');
                }

                if (count($schema_routes) == count($url_routes)) {
                    $success = true;
                    for ($i = 0; $i < count($schema_routes); $i++) {
                        // _idがある場合paramにid key を代入する
                        if ($schema_routes[$i] == '_id' && ctype_digit($url_routes[$i])) {
                            $this->params['id'] = (int)$url_routes[$i];
                            continue;
                        }
                        // 一致しない場合break
                        if ($schema_routes[$i] != $url_routes[$i]) {
                            $success = false;
                            break;
                        }
                    }
                    if ($success) {
                        list($controller, $action) = explode('#', $route['action']);
                        $this->execute_controller_action($controller, $action);
                        return true;
                    }
                }
            }
        }
        $this->execute_controller_action('home', 'not_found_action_method');
        return false;
    }



    function execute_controller_action($controller, $action)
    {
        $controller_class_name = ucfirst($controller) . 'Controller';
        require(PROJECT_ROOT . '/controllers/'.$controller_class_name.'.php');
        $controller_instance = new $controller_class_name($this->params);
        if (method_exists($controller_instance, $action)) { // check existing aciton method
            $controller_instance->$action();
        } else {
            require(PROJECT_ROOT . '/controllers/HomeController.php');
            $not_found_instance = new HomeController($this->params);
            $not_found_instance->not_found_action_method();
        }
    }
}
