<style>
  div.main-content {
    padding-left: 45%;
    margin-top: 20%;
  }

  #review-form {
    margin-top: 10%;
  }

  .review-area {
    margin-top: 7%;
  }
</style>

<div class='main-content'>
  <div><?php echo $params['show_product']['product_name']?></div>

  <script src="assets/js/processing.min.js"></script>
  <script src="assets/js/processing_helper.js"></script>


  <div>
    <canvas id="canvas0" width="200px" height="200px">
        <?php echo $params['show_product']['source_code']?>
    </canvas>
  </div>
  <div>
    <button type="button" class="btn", onclick="run_canvas_code()">Run</button>
    <button type="button" class="btn", onclick="stop()">Stop</button>
  </div>

    <?php if ($_COOKIE['user_id'] == $params['show_product']['user_id']) :?>
      <div>
        <a href='?route=product/<?php echo $params['id']?>/edit'>編集する</a>
      </div>
    <?php endif ?>

    <?php foreach ($params['reviews'] as $review) { ?>
    <div class='review-area'>
      <div>評価: <?php echo $review['rating'] ?></div>
      <div>コメント： <?php echo $review['review'] ?></div>
    </div>
    <?php } ?>

    <?php if (isset($_COOKIE['user_id']) && $_COOKIE['user_id'] != $params['show_product']['user_id']) : ?>
    <div id='review-form'>
      <form action="index.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="route" value="review" /> <?php // ?route=review ?>
        <input type="hidden" name="product_id" value="<?php echo $params['show_product']['id'] ?>" />
        <input type="hidden" name="user_id" value="<?php echo $_COOKIE['user_id'] ?>" />
        <p>5段階評価: <br>
          <select name="rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </p>
        <textarea name='review'></textarea><br>
        <input type='submit' value='評価する'>
      </form>
    </div>
    <?php endif ?>
</div>
