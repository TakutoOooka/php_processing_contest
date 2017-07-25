<link href='assets/css/home/index.css' rel='stylesheet' type='text/css'>
<div class='home-bar'>
  <div class='title-text-area'>
    <span class='main-title-text'>Processing Contest</span><br>
    <span class='sub-title-text'>~みんなの作品を投稿しよう！！~</span>
  </div>
</div>

<div class='main-contents'>
  <div class='products'>
    <p class='section-name'>新規投稿作品</p>
    <div>
        <?php foreach ($params['new_products'] as $product) { ?>
        <div>
            <p><?php echo $product['product_name']?></p>
            <a href='?route=product/<?php echo $product['id']?>'><img src='images/<?php echo $product['image_url']?>' width='200px' height='200px'></a>
        </div>
        <?php } ?>
    </div>
  </div>

  <div class='products'>
    <p class='section-name'>人気作品</p>
    <div>
        <?php foreach ($params['popular_products'] as $product) { ?>
        <div>
            <p><?php echo $product['product_name']?></p>
            <a href='?route=product/<?php echo $product['id']?>'><img src='images/<?php echo $product['image_url']?>' width='200px' height='200px'></a>
        </div>
        <?php } ?>
    </div>
  </div>
</div>