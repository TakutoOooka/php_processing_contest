<?php foreach ($params['all_products'] as $product) { ?>
<div>
    <p><?php echo $product['product_name']?></p>
    <a href='?route=product/<?php echo $product['id']?>'><img src='images/<?php echo $product['image_url']?>'></a>
</div>
<?php } ?>