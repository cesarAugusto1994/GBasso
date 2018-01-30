<div class="container margin-top padding-med-reset">
	<h2>Compra Finalizada.</h2>

	<h3>Sua compra foi finalizada com sucesso, estamos aguardando a confirmação da operadora.</h3>
    <br />
    <br />
    <p>Caso você não seja redirecionado para o seu boleto, clique no botão abaixo.</p>
    <br />
    <br />
    <center>
    <?php if($linkBoleto): ?>
        <a href="<?= $linkBoleto ?>">
            <img src='http://www.grupobasso.com.br/assets/images/boleto.png' alt="boleto" />
            <br />
            <br />
            <button class='btn-success btn-block btn-lg'>Ir para o meu boleto</button>
        </a>
    <?php else: ?>
        <a href="http://www.grupobasso.com.br/minha/conta/compras" class='btn-success btn-block btn-lg'>Ir para minhas compras</a>
    <?php endif; ?>
    </center>
</div>
<script type="text/javascript">
    var page = 'resultbusca';
    var baseUrl  =  '{url}';
</script>
