<div><?=$params['show_product']['name']?></div>

<script src="assets/js/processing.min.js"></script>
<script src="assets/js/processing_helper.js"></script>


<div>
  <canvas id="canvas0" width="200px" height="200px">
    <?=$params['show_product']['source_code']?>
  </canvas>
</div>
<div>
  <button type="button" class="btn", onclick="run_canvas_code()">Run</button>
  <button type="button" class="btn", onclick="stop()">Stop</button>
</div>

<?php if ($_SESSION['user_id'] == $params['show_product']['user_id']) :?>
    <div>
      <a href='?route=product/<?=$params['id']?>/edit'>編集する</a>
    </div>
<?php endif ?>
