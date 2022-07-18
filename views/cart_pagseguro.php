<h1>checkout - Pagseguro</h1>

<h3>Dados Pessoais</h3>
<strong>Nome:</strong><br>
<input type="text" name="name" value="Guilherme Lemos Vieira" id=""><br><br>

<strong>CPF:</strong><br>
<input type="number" value="07067226120" name="cpf" id=""><br><br>

<strong>Email:</strong><br>
<input type="email" name="email" value="c29062419701151259737@sandbox.pagseguro.com.br" id=""><br><br>

<strong>Senha:</strong><br>
<input type="password" name="senha" value="EH3VVv49cRJ02Mbv" id=""><br><br>

<h3>Informações de Endereço</h3>

<strong>CEP:</strong><br>
<input type="text" name="cep" value=78097002 id=""><br><br>

<strong>Complemento:</strong><br>
<input type="text" name="complemento" value="proximo a esquina" id=""><br><br>

<strong>Cidade</strong><br>
<input type="text" name="estado" value="Cuiabá" id=""><br><br>

<strong>estado</strong><br>
<input type="text" name="estado" value="Acre" id=""><br><br>

<h3>Informações de Pagamento</h3>

<strong>Número do cartão</strong><br>
<input type="number" name="cartao_numero" id=""><br><br>

<strong>CVV</strong><br>
<input type="number" name="cvv" id=""><br><br>

<strong>Expriração:</strong><br>
<select name="cartao_mes" id="">
        <?php for($q=1;$q<=12;$q++):?>
            <option value=""><?php echo ($q<10)?'0'.$q:$q;;?></option>
        <?php endfor;?>
</select>
<select name="cartao_ano" id="">
    <?php $ano = intval(date('Y'));?>
        <?php for($q=$ano;$q<=($ano+20);$q++):?>
            <option value=""><?php echo $q?></option>
        <?php endfor;?>
</select><br><br>
<button class="button_pay">Finalizar Compra</button>
<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/pagseguro.js"></script>
<script type="text/javascript">
PagSeguroDirectPayment.setSessionId("<?php echo $sessionCode; ?>");
</script>
