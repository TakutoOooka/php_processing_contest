<?php foreach ($params['my_products'] as $product) { ?>
<div>
    <p><?=$product['product_name']?></p>
    <a href='?route=product/<?=$product['id']?>'><img src='images/<?=$product['image_url']?>'></a>
</div>
<?php } ?>