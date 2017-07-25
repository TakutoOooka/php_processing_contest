<?php foreach ($params['my_products'] as $product) { ?>
<div>
    <p><?php echo $product['product_name']?></p>
    <a href='?route=product/<?php echo $product['id']?>'>
      <img width='200px' height='200px' src='images/<?php echo $product['image_url']?>' onerror="this.src='assets/image/noimage.png'">
    </a>
</div>
<?php } ?>