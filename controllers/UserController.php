<?php
include(PROJECT_ROOT . '/library/BaseController.php');
class UserController extends BaseController
{
    private $record;

    public function __construct($params)
    {
        parent::__construct($params);
        $this->controller = 'user';
        require_once(PROJECT_ROOT . '/models/UserModel.php');
    }

    public function index()
    {
        $this->render_view('index');
    }

    public function show()
    {
        $this->render_view('show');
    }

    public function new_action()
    {
        $this->render_view('new_action');
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

        $this->render_view('create');
    }

    public function edit()
    {
        $this->render_view('edit');
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
        $this->render_view('update');
    }

    public function sign_in()
    {
        $this->render_view('sign_in');
    }

    public function signed_in()
    {

        // UserModelのインスタンスを生成
        $user = new UserModel();

        if ($user_record = $user->find_by('sign_in_id', $this->h($this->params['sign_in_id']) )) {
            if ($user_record['encrypted_passwd'] == $this->h($this->params['passwd'])) {
                $this->params['success_session'] = true;
                $_COOKIE['user_id'] = $user_record['id'];
                setcookie('user_id', $user_record['id'], time()+12*3600); // Cookieは12時間持続
            } else {
                $this->params['passwd_failure'] = true;
            }
        } else {
            $this->params['id_failure'] = true;
        }

        $this->render_view('signed_in');
    }

    public function signed_out()
    {
        setcookie('user_id', '', time() - 1800);
        $this->render_view('signed_out');
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
