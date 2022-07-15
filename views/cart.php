<h1>Carrinho de compras</h1>
<table border="0" width="100%"> 
    <tr>
        <th width="100">Imagem</th>
        <th>Nome</th>
        <th width="50">Qtd.</th>
        <th width="120">Preço</th>
    </tr>
    <?php
    $subtotal = 0;
    ?>
    <?php foreach($products  as $product):?>
        <?php $subtotal += (floatval($product['price'])*floatval($product['qt']))?>
        <?php if($product['qt']==0):?>
            <form action="<?php echo BASE_URL;?>/cart/remove/<?php $product['id'];?>">
            <input type="hidden" value="<?php echo BASE_URL;?>/cart/remove/<?php $product['id'];?>">
            </form>
        <?php endif;?>
        <tr>
            <th><img src="<?php echo BASE_URL;?>media/products/<?php echo $product['image']?>" width="80" alt=""></th>
            <th><?php echo $product['name'];?></th>
            <th><?php echo $product['qt'];?></th>
            <th><?php echo "R$ ".number_format($product['price'], 2, ',', '.');?></th>
            <th width="20"><a href="<?php BASE_URL;?>cart/subtraction/<?php echo $product['id']?>"><img src="<?php echo BASE_URL;?>assets/images/subtraction.png" width="25" alt=""></a></th>
            <th width="20"><a href="<?php BASE_URL;?>cart/remove/<?php echo $product['id']?>"><img src="<?php echo BASE_URL;?>assets/images/delete.png" width="30" alt=""></a></th>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="3" align="right">Sub-total:</td>
        <td><strong><?php echo 'R$ '.number_format($subtotal,2, ',', '.');?></strong></td>
        <td></td>
    </tr>
</table>
<hr>
Qual seu CEP?<br/>
<form action="">
    <input type="number" name="cep"><br>
    <input type="button" value="calcular">
</form>