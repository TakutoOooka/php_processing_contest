<?php

abstract class BaseController
{
    protected $params;
    protected $controller;

    // コンストラクタ
    public function __construct($params)
    {
        $this->params = $params;
    }

    // 全画面共通処理
    protected function pre_common_action()
    {
    }

    // // ビューの初期化
    protected function render_view($action)
    {
        $params = $this->params;
        $controller = $this->controller;
        include(PROJECT_ROOT . '/views/application.php');
    }
}
