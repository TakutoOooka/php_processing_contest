<?php include(PROJECT_ROOT . '/views/product/_processing_exec.php'); ?>

<link href='assets/css/product/common.css' rel='stylesheet' type='text/css'>
<link href='assets/css/product/development.css' rel='stylesheet' type='text/css'>

<div class='main-contents'>
  <form action="index.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="route" value="product/<?php echo $params['id']?>/update" /> <?php // ?route=product ?>
    <input type="hidden" name="image_name" value="<?php echo $_COOKIE['user_id']?>"> <?php // temp image file name ?>
    <div>
      <canvas id="canvas0" width="200px" height="200px">
      </canvas><br>
<textarea id="source_code" name='source_code' cols="50px" rows="10">
<?php echo $params['edit_data']['source_code']?>
</textarea>
    </div>
    <div>
      <button type="button" class="btn", onclick="run_textarea_code()">Run</button>
      <button type="button" class="btn", onclick="stop()">Stop</button>
      <input type="submit" value="submit">
    </div>
  </form>

  <form id='ajax_form'>
    <button type="button" class="btn", onclick="display_capture()">Capture</button>
  </form>

  <div id="capture_image"></div>
</div>