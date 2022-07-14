<?php
class Filters extends Model{
    public function getFilters($filters){

        $brands = new Brands();
        $products = new Products();

        $array = [
            'searchTerm' => '',
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
            'slider0' =>0,
            'slider1'=>0,
            'sale' => 0, 
            'options' => []
        ];

        if(isset($filters['searchTerm'])){
            $array['searchTerm'] = $filters['searchTerm'];
        }
        
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
        if(isset($filters['slider0'])){
            $array['slider0'] = $filters['slider0'];
        }
        if(isset($filters['slider1'])){
            $array['slider1'] = $filters['slider1'];
        }
        $array['maxslider'] = $products->getMaxPrice($filters);
        if($array['slider1'] == 0){ 
            $array['slider1'] = $array['maxslider'];
        }
          

        //criando o filtro das estrelas
        $star_products = $products->getListOfStars($filters);
        foreach($array['stars'] as $skey => $sitem){
            foreach($star_products as $sproduct){
                if($sproduct['rating'] == $skey){
                    $array['stars'][$skey] = $sproduct['c'];
                }
            }
        }
        //filtro de promoção
        $array['sale'] = $products->getSaleCount($filters);

        //filtros das opções 
        $array['options'] = $products->getAvailableOptions($filters);
       
        return $array;
    }
}