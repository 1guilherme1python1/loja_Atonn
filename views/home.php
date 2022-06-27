<div class="row">
    <?php
    $a=0;
    ?>
    <?php foreach($list as $product_item):?>
    <div class="col-sm-4">
        <?php $this->loadView('product_item', $product_item) ?>
    </div>
    <?php
        if($a>=2){
            $a=0;
            echo '</div><div class="row">';
        } else {
        $a++;
        }
    ?>
    <?php endforeach ?>
</div>
<?php
echo '<pre>';
print_r($list);