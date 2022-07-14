<div class="row">
    <div class="col-sm-5">
            <div class="mainphoto">
                <img src="<?php echo BASE_URL;?>media/products/<?php echo $info_images[0]['url']?>" height="200" alt="">
            </div>
            <div class="gallery">
            <div class="photo_item0">
                    <img src="<?php echo BASE_URL;?>media/products/<?php echo $info_images[0]['url']?>" alt="">
                </div>
                <div class="photo_item1">
                    <img src="<?php echo BASE_URL;?>media/products/<?php echo $info_images[1]['url']?>" alt="">
                </div>
                <div class="photo_item2">
                    <img src="<?php echo BASE_URL;?>media/products/<?php echo $info_images[2]['url']?>" alt="">
                </div>
                <div class="photo_item3">
                    <img src="<?php echo BASE_URL;?>media/products/<?php echo $info_images[3]['url']?>" alt="">
                </div>
            </div>                 
    </div>                 

    <div class="col-sm-7">
        <h2><?php echo $info['name']; ?></h2>
        <small><?php echo $info['brand_name']; ?></small><br>
        <?php if($info['rating'] != '0'):?>
            <?php for($q=0; $q<intval($info['rating']); $q++): ?>
                <img src="<?php echo BASE_URL;?>assets/images/star.png" height="15" alt="">
            <?php endfor; ?>
        <?php endif; ?>
        <hr>
        <p><?php echo $info['description']?></p>
        De:<span class="price_from"><?php echo 'R$ '.number_format($info['price_from'], 2);?></span><br>
        Por:<span class="original_price"><?php echo 'R$ '.number_format($info['price'], 2);?></span>

        <form action="<?php echo BASE_URL;?>cart/add" method="POST" class="addtocartform">
            <input type="hidden" name="id_product" value="<?php echo $info['id']; ?>"/>
            <input id="valueQuantyProduct" type="hidden" name="qt_product" value="1">
            <button id="buttonClickDown">-</button>
            <input type="text" name="qt" disabled class="addtocart_qt" value="1">
            <button id="buttonClickUp">+</button>
            <input class="addtocart_submit" type="submit" value="<?php $this->lang->get('ADD_TO_CART')?>">
        </form>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-6">
        <h3><?php $this->lang->get('SPECIFICATIONS');?></h3>
        <?php foreach($products_options as $po):?>
            <strong><?php echo $po['name']?></strong>: <?php echo $po['value']?><br>
        <?php endforeach;?>
    </div>
    <div class="col-sm-6">
        <h3>Resenhas</h3>
        <?php foreach($products_rates as $rate): ?>
            <strong><?php echo $rate['user_name'];?>:</strong>
            <?php for($q=0;$q<intval($rate['points']);$q++):?>
                <img src="<?php echo BASE_URL;?>/assets/images/star.png" alt="" height="13">
            <?php endfor; ?><br>
            "<?php echo $rate['comment']?>"<br><br>
        <?php endforeach; ?>
    </div>
</div>