<?php if (isset( $params['success_session'] )) : ?>
<div>ログインに成功しました</div>
<?php elseif (isset($params['id_failure'])) : ?>
<div>IDが間違えています。もう一度ログインしてください</div>
<?php elseif (isset( $params['passwd_failure'] )) : ?>
<div>パスワードが間違えています。もう一度ログインしてください</div>
<?php else : ?>
<div>不明なエラーです</div>
<?php endif; ?>
