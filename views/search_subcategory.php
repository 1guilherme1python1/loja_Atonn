<?php foreach($subs as $sub):?>
<option <?php echo (isset($category) && $category==$sub['id'])?'selected="selected"':'';?> value="<?php echo $sub['id'];?>">
    <?php
        for($q=0;$q<$level;$q++) echo '-';
        echo $sub['name'];
    ?>
</option>
    
    <?php if(count($sub['subs'])>0){
        $this->loadView('search_subcategory',[
            'subs' => $sub['subs'],
            'level'=> $level+1,
            'category'=>$category
        ]);
    } ?>
<?php endforeach;?>