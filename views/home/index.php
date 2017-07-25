<?php

?>

<link href='assets/css/home/index.css' rel='stylesheet' type='text/css'>

<div class='main-contents'>
  <div class='products'>
    <p>新規投稿作品</p>
    <div>
        <?php foreach ($params['new_products'] as $product) { ?>
      <div>
          <p><?php echo $product['product_name']?></p>
          <a href='?route=product/<?php echo $product['id']?>'><img src='images/<?php echo $product['image_url']?>'></a>
      </div>
        <?php } ?>
    </div>
  </div>

  <div class='products'>
    <p>人気作品</p>
    <div>
        <?php foreach ($params['popular_products'] as $product) { ?>
      <div>
          <p><?php echo $product['product_name']?></p>
          <a href='?route=product/<?php echo $product['id']?>'><img src='images/<?php echo $product['image_url']?>'></a>
      </div>
        <?php } ?>
    </div>
  </div>
</div>