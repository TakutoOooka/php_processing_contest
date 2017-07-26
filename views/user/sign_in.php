<style>
  div.main-content {
    padding-left: 43%;
    margin-top: 20%;
  }
</style>

<div class='main-content'>
    <span>ログイン</span>
  <form action='' method='POST'>
    <input type="hidden" name="route" value="user/signed_in" />
    <div>
      <label for='id'>ID:</label><br>
      <input type='text' name='sign_in_id'>
    </div>
    <div>
      <label for='password'>Password: </label><br>
      <input type='password' name='passwd'>
    </div>
    <div>
      <input type='submit' value='ログイン'>
    </div>
  </form>
</div>