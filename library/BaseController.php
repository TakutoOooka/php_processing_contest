<?php
include(PROJECT_ROOT . '/models/UserModel.php');
abstract class BaseController
{
    protected $params;
    protected $controller;

    // コンストラクタ
    public function __construct($params)
    {
        $this->params = $params;
        $this->pre_common_action();
    }

    // 全画面共通処理
    protected function pre_common_action()
    {
    }

    private function regenerate_cookie()
    {
        // ユーザー認証成功処理
        if (isset($_COOKIE['user_id'])) {
            $user = new UserModel();
            $user_record = $user->find_by('id', $_COOKIE['user_id']);
            $user_record['last_sign_in_at'] = date('Y-m-d H:i:s');
            $user->save($user_record);
            setcookie('user_id', $user_record['id'], time()+3600); // Cookieは12時間持続
        }
    }

    // // ビューの初期化
    protected function render_view($action)
    {
        $params = $this->params;
        $controller = $this->controller;
        include(PROJECT_ROOT . '/views/application.php');
    }
}
