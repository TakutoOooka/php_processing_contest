<?php

abstract class ControllerBase
{
    public $param;

    // コンストラクタ
    public function __construct()
    {
        $this->sys_root = dirname(__FILE__) . "/..";
    }

    // ビューの初期化
    protected function render_view($controller, $action)
    {
        include($sys_root . '/view/application.php');
    }

    // 全画面共通処理
    protected function pre_common_action()
    {
    }
}
