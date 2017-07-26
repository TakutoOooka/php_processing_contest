<style>
  div.main-content {
    padding-left: 43%;
    margin-top: 20%;
  }
</style>

<div class='main-content'>
<?php if (isset( $params['success_session'] )) : ?>
<div>ログインに成功しました(2秒後にHOMEに戻ります)</div>
<?php elseif (isset($params['id_failure'])) : ?>
<div>IDが間違えています。もう一度ログインしてください</div>
<?php elseif (isset( $params['passwd_failure'] )) : ?>
<div>パスワードが間違えています。もう一度ログインしてください</div>
<?php else : ?>
<div>不明なエラーです</div>
<?php endif; ?>
</div>

<script>
  function redirect(){
      location.href='?route=home';
  }
  setTimeout("redirect()", 2000);
</script>