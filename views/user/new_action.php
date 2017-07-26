<style>
  div.main-content {
    padding-left: 43%;
    margin-top: 20%;
  }
</style>

<script src='assets/js/user/new_action.js'>
</script>

<div class='main-content'>
    <span>新規登録</span>
  <form action='' method='POST'>
    <input type="hidden" name="route" value="user" /> <?php // ?route=user ?>
    <div>
      <label for='id'>ID:</label><br>
      <input type='text' name='sign_in_id'>
    </div>
    <div>
      <label for='password'>Password: </label><br>
      <input id='passwd' type='password' name='passwd'>
    </div>
    <div>
      <input type='submit' value='登録'>
    </div>
  </form>
</div>

