<?php
class Cart extends Model{
    public function getList(){
        $array = [];

        $products = new Products();
        
        if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];
        

        foreach($cart as $id => $qt){

            $info = $products->getInfo($id);

            $array[] = [
                'id' => $id,
                'name' => $info['name'],
                'qt' => $qt,
                'price' => $info['price'],
                'image' => $info['images']
            ];
        }
    }
        return $array;
    } 
    public function getSubtotal(){
        $list = $this->getList();

        $subtotal = 0;

        foreach($list as $item){
            $subtotal = (floatval($item['price']) * intval($item['qt']));
        }
        return $subtotal;
    }
    public function shippingCalculate($cepDestination){
        $array = [
            'price' => 0,
            'date' => ''
        ];

        global $config;

        $data = [
            'nCdServico' => '40010',
            'sCepOrigem' => $config['cep_origin'],
            'sCepDestino' => $cepDestination,
            'nVlPeso' => '',
            'nCdFormato' => '1',
            'nVlComprimento' => '',
            'nVlAltura' => '',
            'nVlLargura' => '',
            'nVlDiametro' =>'', 
            'sCdMaoPropria' => 'N',
            'nVlValorDeclarado' => '',
            'nCdAvisoRecebimento' => 'N',
            'StrRetorno' => 'xml'
        ];
        $url = 'http://ws.correios.com.br/calculador/CalcPrecoprazo.aspx';
        $data = http_build_query($data);

        $ch = curl_init($url.'?'.$data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $r = curl_exec($ch);
        $r = simplexml_load_string($r);


        $array['price'] = $r->cServico->Valor;
        $array['date'] = $r->cServico->PrazoEntrega;
         
        return $array;
    }
}