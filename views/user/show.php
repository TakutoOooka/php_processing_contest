<?php
if (isset($_COOKIE['user_id'])) {
    $authentication = true;
}
if (isset($params['id'])) {
    $user = new UserModel();
    $user_info = $user->find_by('id', $params['id']);
}
?>
<link href="assets/css/user/show.css" rel="stylesheet" type="text/css">

<div class='main-content'>
  <p>ユーザー名: <?php echo $user_info['name']?></p>
  <p>画像: <img src='<?php echo $user_info['icon_uri']?>' width='100px' height='100px'></img></p>
<?php if (isset($_COOKIE['user_id'])) : ?>
  <a href='?route=user/<?php echo $user_info['id']?>/edit'>編集</a>
<?php endif ?>
</div>