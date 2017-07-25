
<?php if ($_COOKIE['user_id'] == $params['id']) : ?>
<?php $user = new UserModel();
$current_user = $user->find_by('id', $_COOKIE['user_id']);
?>

<link href="assets/css/user/edit.css" rel="stylesheet" type="text/css">

<div class='main-content'>
  <h1>ユーザー情報編集画面</h1>

  <form method="POST" action="">
      <div>
        <label for='sign_in_id'>ID</label><br>
        <input type='text' name='sign_in_id' value='<?php echo $current_user['sign_in_id']?>'>
      </div>
      <div>
        <label for='username'>ユーザー名</label><br>
        <input type='text' name='username' value='<?php echo $current_user['name']?>'>
      </div>
      <div>
        <label for='passwd'>パスワード</label><br>
        <input type='text' name='passwd' value=''>
      </div>
      <input type="hidden" name="route" value="user/<?php echo $current_user['id']?>/update" /> <?php // ?route=user ?>
      <input type="submit" value="編集">
  </form>
</div>

<?php else :
    header('Location: ?route=home');
    exit;
endif ?>
</div>