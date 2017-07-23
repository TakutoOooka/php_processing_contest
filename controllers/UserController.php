<?php
class UserController
{
    private $params;
    private $record;

    public function __construct($params)
    {
        require_once(PROJECT_ROOT . '/models/UserModel.php');
        session_start();
        $this->params = $params;
    }

    public function index()
    {
        // $model = new UserModel();
        $this->render_view('user', 'index');
    }

    public function show()
    {
        $this->render_view('user', 'show');
    }

    public function new_action()
    {
        $this->render_view('user', 'new_action');
    }

    public function create()
    {
        $user = new UserModel();

        // UserModelのインスタンスを生成
        $new_record = $user->new_record();

        // POST通信のパラメータを取得
        $new_record['sign_in_id'] = $this->h($this->params['sign_in_id']);
        $new_record['encrypted_passwd'] = $this->h($this->params['passwd']);

        // recordの保存
        $user->save($new_record);

        $this->render_view('user', 'create');
    }

    public function edit()
    {
        $this->render_view('user', 'edit');
    }

    public function update()
    {
        $user = new UserModel();

        // UserModelのインスタンスを生成
        $edit_record = $user->find_by('id', $this->params['id']);

        // POST通信のパラメータを取得
        $edit_record['name'] = $this->h($this->params['username']);
        $edit_record['sign_in_id'] = $this->h($this->params['sign_in_id']);
        $edit_record['encrypted_passwd'] = $this->h($this->params['passwd']);

        // recordの保存
        $user->save($edit_record);
        $this->render_view('user', 'update');
    }

    public function sign_in()
    {
        $this->render_view('user', 'sign_in');
    }

    public function signed_in()
    {

        // UserModelのインスタンスを生成
        $user = new UserModel();

        if ($user_record = $user->find_by('sign_in_id', $this->h($this->params['sign_in_id']) )) {
            if ($user_record['encrypted_passwd'] == $this->h($this->params['passwd'])) {
                $this->params['success_session'] = true;
                $_SESSION['user_id'] = $user_record['id'];
            } else {
                $this->params['passwd_failure'] = true;
            }
        } else {
            $this->params['id_failure'] = true;
        }

        $this->render_view('user', 'signed_in');
    }

    public function signed_out()
    {
        session_unset();
        session_destroy();
        $this->render_view('user', 'signed_out');
    }

    function render_view($controller, $action)
    {
        $params = $this->params;
        include(PROJECT_ROOT . '/views/application.php');
    }

    function generate_token()
    {
    // セッションIDからハッシュを生成
        return hash('sha256', session_id());
    }

    function validate_token($token)
    {
        // 送信されてきた$tokenがこちらで生成したハッシュと一致するか検証
        return $token === generate_token();
    }

    function h($str)
    {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
}
