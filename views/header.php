<?php
require_once(PROJECT_ROOT . '/models/UserModel.php');
if (isset($_COOKIE['user_id'])) {
    $user = new UserModel();
    $user->find_by('id', $_COOKIE['user_id']);
}
?>
<link href='assets/css/header.css' rel='stylesheet' type='text/css'>

<ul class="navbar">
    <li>
      <span id='title_tag'>Processing Contest</span>
    </li>
    <li>
        <a href="?route=home">
            <strong>ホーム</strong>
            <span>home</span>
        </a>
    </li>
    <?php if (isset($_COOKIE['user_id'])) : ?>
    <li>
        <a href="?route=user/<?php echo $_COOKIE['user_id']?>">
            <strong>マイページ</strong>
            <span>my page</span>
        </a>
    </li>
    <li>
        <a href="?route=user/signed_out">
            <strong>ログアウト</strong>
            <span>sign out</span>
        </a>
    </li>
    <li>
        <a href="?route=product/show_my_products">
            <strong>ユーザー作品一覧</strong>
            <span>my products</span>
        </a>
    </li>
        <li>
        <a href="?route=product/new">
            <strong>新規作品投稿</strong>
            <span>new product</span>
        </a>
    </li>
    <?php else : ?>
        <li>
        <a href="?route=user/new">
            <strong>新規登録</strong>
            <span>regist</span>
        </a>
    </li>
    <li>
        <a href="?route=user/sign_in">
            <strong>ログイン</strong>
            <span>sign in</span>
        </a>
    </li>
    <?php endif ?>
</ul>
