    <!--
    <footer id="footer" class="midnight-blue margin-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                     Copyright &copy; 2015 <a target="_blank" href="http://www.webmkt.com.br/"> VTenis </a>
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="{url}home/index">Home</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    -->

    <footer class="footer" style='background-color: #000000; padding-top: 20px;'>
        <div class="row">
            <div class="col-md-4 col-xs-4" style="border-right: 1px solid #FFFFFF">
                <p style='text-align: center; font-size: 20px; color: #FFFFFF'>Santo André</p>
                <p style='text-align: center;; color: #FFFFFF'>Rua Cel. Alfredo Fláquer, 686 </p>
                <p style='text-align: center;; color: #FFFFFF'>Telefone: 11 4438-1566</p>
                <p style='text-align: center;; color: #FFFFFF'>
                    <img width="15px" src="http://www.grupobasso.com.br/assets/images/whatapp.png"/>&nbsp; <a style="color:white;font-size:14px;" target="_blank" href="https://api.whatsapp.com/send?phone=+5511952540191&text=Ola%20Grupo%20Basso">11 95254-0191 </a>
                </p>
                 <p style='text-align: center;; color: #FFFFFF'>bassosa@grupobasso.com.br</p>
               <!-- <p style='text-align: center;'>Horário de Funcionamento: Seg. a Sex. das 9hs às 20hs</p>
                <p style='text-align: center;'>Sábado das 9hs às 16hs.</p>-->
            </div>
            <div class="col-md-4 col-xs-4" style=" color: #ffffff; border-right: 1px solid #FFFFFF">
                <p style='text-align: center; color: #ffffff;  font-size: 20px'>São Bernardo do Campo</p>
                <p style='text-align: center; color: #ffffff; '>Av. Getulio Vargas, 1510</p>
                <p style='text-align: center; color: #ffffff; '>Telefone 11 4330-8411</p>
                 <p style='text-align: center; color: #ffffff; '><img width="15px" src="http://www.grupobasso.com.br/assets/images/whatapp.png"/>&nbsp; <a style="color:white;font-size:14px;" target="_blank" href="https://api.whatsapp.com/send?phone=+55119525416176&text=Ola%20Grupo%20Basso">11 95254-1617</a></p>
                  <p style='text-align: center; color: #ffffff; '>bassosbc@grupobasso.com.br</p>
                              <!--  <p style='text-align: center;'>Segunda a Sexta das 16hs às 20hs</p>
                <p style='text-align: center;'>Sáb., Dom. e Feriados das 9hs às 14hs.</p>-->

            </div>
            <div class="col-md-4 col-xs-4">
                <p style='text-align: center; color: #ffffff; font-size: 20px'>São Caetano do Sul</p>
                <p style='text-align: center; color: #ffffff;'>Rua Heloisa Pamplona, 428</p>
                <p style='text-align: center; color: #ffffff;'>Telefone 11 4221-5211</p>
                <p style='text-align: center; color: #ffffff;'><img width="15px" src="http://www.grupobasso.com.br/assets/images/whatapp.png"/>&nbsp; <a style="color:white;font-size:14px;" target="_blank" href="https://api.whatsapp.com/send?phone=+5511941460806&text=Ola%20Grupo%20Basso">11 94146-0806</a></p>
                <p style='text-align: center; color: #ffffff;'>bassosc@grupobasso.com.br</p>
               <!-- <p style='text-align: center;'>Sábado: das 07hs às 18hs</p>
                <p style='text-align: center;'>Domingo: 07hs às 14h.</p>-->
            </div>
            <div class="col-md-12">
                <hr />
                <p style='text-align: center; font-size: 20px'</p>
                <p style='text-align: center;'></p>
            </div>
        </div>
    </footer>

    {js}

    <script type='text/javascript' src='http://www.grupobasso.com.br/assets/js/login.js'></script> 
    <script type='text/javascript' src='http://www.grupobasso.com.br/assets/js/pnotify.custom.min.js'></script> 
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js'></script> 
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.0/alertify.min.js'></script>
    <script type='text/javascript' src='https://cdn.awsli.com.br/production/static/loja/estrutura/v1/js/jquery.card.js?v=59b27ee'></script>
    <script type='text/javascript' src='https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js?421308'></script>

<script> //Máscaras dos inputs
  jQuery(function($){
  $("#creditCardHolderBirthDate").mask("99/99/9999");
  $("#senderCPF").mask("999.999.999-99");
  $("#creditCardHolderCPF").mask("999.999.999-99");
  $("#shippingAddressPostalCode").mask("99999-999");
  $("#billingAddressPostalCode").mask("99999-999");
  });

  $(document).ready(function() {
    $.ajax({
      type: 'GET',
      url: '/compras/session',
      cache: false,
      success: function(data) {
        PagSeguroDirectPayment.setSessionId(data);
      }
    });
  });
</script>
</body>
</html>