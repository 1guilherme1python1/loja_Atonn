<h1><?php echo $category_name; ?></h1>
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
<?php for($q=1;$q<=$numberOfPages;$q++): ?>
    <div class="paginationItem <?php echo ($currentPage == $q) ? 'ItemActive' : '';?>"><a href="<?php echo BASE_URL;?>?p=<?php echo $q;?>"><?php echo $q;?></a></div>
<?php endfor;?>