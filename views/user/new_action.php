<div>
  <span>新規登録</span>
  <form action='' method='POST'>
    <input type="hidden" name="route" value="user" /> <?php // ?route=user ?>
    <div>
      <label for='id'>ID:</label>
      <input type='text' name='sign_in_id'>
    </div>
    <div>
      <label for='password'>Password: </label>
      <input type='password' name='passwd'>
    </div>
    <div>
      <input type='submit' value='登録'>
    </div>
  </form>
</div>