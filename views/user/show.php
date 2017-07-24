<?php
if (isset($_COOKIE['user_id'])) {
    $authentication = true;
}
if (isset($params['id'])) {
    $user = new UserModel();
    $user_info = $user->find_by('id', $params['id']);
}
?>

<div>
  <p>ユーザー名: <?php echo $user_info['name']?></p>
  <p>画像gazou: <?php echo $user_info['image_uri']?></p>
<?php if (isset($_COOKIE['user_id'])) : ?>
  <a href='?route=user/<?=$user_info['id']?>/edit'>編集</a>
<?php endif ?>
</div>