<?php
class Filters extends Model{
    public function getFilters($filters){

        $brands = new Brands();
        $products = new Products();

        $array = [
            'brands' => [],
            'maxslider' => 1000,
            'stars' => [
                '0' => 0,
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0
            ],
            'sale' => false, 
            'options' => []
        ];

        $array['brands'] = $brands->getList();
        $brands_products = $products->getListOfBrands($filters);

        //criando o filtro de marcas
        foreach($array['brands'] as $bkey => $bitem){
            //caso não haver produtos com essa marca lhe sera atribuido valor 0;
            $array['brands'][$bkey]['count'] = 0;

            foreach($brands_products as $bproduct){
                if($bproduct['id_brand'] == $bitem['id']){
                    $array['brands'][$bkey]['count'] = $bproduct['c'];
                }
            }
            if($array['brands'][$bkey]['count']==0){
                unset($array['brands'][$bkey]);
            }
        }
        //criando o filtro de preço
        $array['maxslider'] = $products->getMaxPrice($filters);

        //criando o filtro das estrelas
        $star_products = $products->getListOfStars($filters);
        foreach($array['stars'] as $skey => $sitem){
            foreach($star_products as $sproduct){
                if($sproduct['rating'] == $skey){
                    $array['stars'][$skey] = $sproduct['c'];
                }
            }
        }

        return $array;
    }
}