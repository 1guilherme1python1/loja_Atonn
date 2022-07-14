<?php foreach($list as $item):?>
<div class="widget_item">
    <a href="">  
	    <div class="widget_info">
			<div class="widget_productname"><?php echo $item['name'];?></div>
			<div class="widget_price"><span><?php echo ($item['price_from']!=0)?'R$'.number_format($item['price_from'],2):'';?></span>R$ <?php echo number_format($item['price'],2);?></div>
         </div>
            <div class="widget_photo">
				<img src="<?php echo BASE_URL;?>media/products/<?php echo $item['products_images'][0]['url']?>" alt="" >
			</div> 
            <div style="clear:both;"></div>
    </a>
</div>
<?php endforeach;?>