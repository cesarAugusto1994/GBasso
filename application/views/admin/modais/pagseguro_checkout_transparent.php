<div class="modal fade" id="pagseguro_checkout_transparent">
    <div class="modal-dialog" style='width: 800px;'>
        <div class='load-data-pagseguro'>
            <img src='{url}assets/images/ajax-loader.gif' />
            <span>Validando os servidores...</span>
        </div>
        <div class="modal-content">
            <div class="modal-header header-modal-pagseguro">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class='col-lg-5 no-padding'>
                    <div class="col-lg-6 pull-right no-padding">
                        <span class='pagseguro-comprador margin-bottom-4'><b>Olá</b>, {nome}!</span>
                        <span class='pagseguro-comprador'>Sua compra: <b>{total}</b></span>
                    </div>
                </div>
                <div class='col-lg-5 pull-right'>
                    <div class='pull-right'>
                        <span class='pagseguro-etapa active-etapa'>Identificação</span>
                        <span class='pagseguro-etapa'>Dados</span>
                        <span class='pagseguro-etapa'>Pagamento</span>
                        <span class='pagseguro-etapa'>Conclusão</span>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <form class='formPagseguro' method='POST' action='{url}compras/carrinho/finalizar/compra'>
                        <div class="col-lg-12 section-endereco hidden">
                            <table class='table'>
                                <thead>
                                    <tr>
                                        <th>Cep</th>
                                        <th>Endereço</th>
                                        <th>Bairro</th>
                                        <th>Número</th>
                                        <th>Comple.</th>
                                        <th>Cidade/Estado</th>
                                    </tr>
                                </thead>
                                <tbody class='selecioneEnderecos'>
                                    <tr>
                                        <td colspan="6" class='text-center'>Nenhum endereço cadastrado</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12 section-pagamento " data-section='1'>
                            <div class="col-lg-8 no-padding">
                                <label>Informe seu email</label>
                                <input type='text' class='form-control' name='email' value='' placeholder="Informe seu e-mail" />
                            </div>
                            <div class="col-lg-4 no-padding">
                                <div class='arrow_box'>
                                    <p class='pagseguro-p'>Tem conta no PagSeguro?</p>
                                    <p class='pagseguro-p-2'>Use seu e-mail cadastrado</p>
                                    <p class='pagseguro-p'>Não tem conta no PagSeguro?</p>
                                    <p class='pagseguro-p-2'>Use seu e-mail pessoal, você poderá criar sua conta depois</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 section-pagamento no-padding hidden" data-section='2'>
                            <div class='col-lg-6'>         
                                <div class='col-lg-12 margin-bottom-17'>
                                    <h1 style='color: #5EB830; font-size: 20px;' class='no-margin'>Dados pessoais</h1>
                                </div>                       
                                <div class='col-lg-12 margin-bottom-17'>

                                    <label>E-mail: </label>
                                    <span class='email-span'></span>
                                </div>                            
                                <div class='col-lg-12 margin-bottom-17'>
                                    <label>Nome Completo</label>
                                    <input type='text' class='form-control' name='nome' value='' />
                                </div>
                                <div class='col-lg-12 margin-bottom-17'>
                                    <label>CPF</label>
                                    <input type='text' class='form-control' name='cpf' value='' />
                                </div>
                                <div class='col-lg-12 margin-bottom-17'>
                                    <label style='width: 100%; float: left;'>Telefone</label>
                                    <input type='text' class='form-control' name='ddd' value='' style='text-align: center; width: 60px; float: left;' /> 
                                    <input type='text' class='form-control' name='telefone' value='' style='text-align: center; width: 255px; float: left; margin-left: 20px;' />                               
                                </div>                             
                            </div>
                            <div class='col-lg-6'>         
                                <div class='col-lg-12 margin-bottom-17'>
                                    <h1 style='color: #5EB830; font-size: 20px;' class='no-margin'>Endereço para entregar</h1>
                                </div>                                                  
                                <div class='col-lg-12 margin-bottom-17'>
                                    <label>CEP</label>
                                    <input type='text' class='form-control' readonly name='cepEntrega' />
                                    <span class='selectEndereco' title='Clique para selecionar um endereço já cadastrado'>Selecione um endereço cadastrado</span>
                                </div>
                                <div class='col-lg-12 margin-bottom-17'>                                                                                                                                                              
                                    <label>Endereço: </label>
                                    <span class='enderecoEntrega'>endereço...</span>
                                </div>
                                <div class='col-lg-6 margin-bottom-17'>
                                    <label>Número</label>
                                    <input type='text' class='form-control' name='numero' readonly />
                                </div>
                                <div class='col-lg-6 margin-bottom-17'>
                                    <label>Complem.</label>
                                    <input type='text' class='form-control' name='complemento' readonly />
                                </div>
                                <div class='col-lg-7 margin-bottom-17'>
                                    <label>Frete</label>
                                    <select class='form-control selectpicker' name='servicoFrete' disabled id='servicoFrete'>
                                        <option value="">Selecione o endereço </option>
                                        <option value="1">PAC </option>
                                        <option value="2">SEDEX </option>
                                    </select>
                                </div>
                                <div class='col-lg-5 margin-bottom-17'>
                                    <label style='float: left; margin-bottom: 20px; width: 100%;'>Valor do frete: </label>
                                    <span class='valorFrete'>0,00</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 section-pagamento no-padding hidden" data-section='3'>
                            <div class='col-lg-12'>
                                <div class='col-lg-4'>
                                    <div class="radio">
                                        <input type='radio' name='tpPag' value='1' id='cartao' checked class='no-margin-top'/>
                                        <label class="no-padding meio-pag-active">Cartão de Crédito</label>
                                    </div>
                                </div>
                                <div class='col-lg-4'>
                                    <div class="radio">
                                        <input type='radio' name='tpPag' value='2' id='boleto' class='no-margin-top'/>
                                        <label class="no-padding">Boleto</label>
                                    </div>
                                </div>
                                <div class='col-lg-4'>
                                    <div class="radio">
                                        <input type='radio' name='tpPag' value='3' id='debito' class='no-margin-top'/>
                                        <label class="no-padding">Débito online</label>
                                    </div>
                                </div>
                            </div>
                            <div class='col-lg-12 field-debito-online'>
                                <div class="col-lg-12 margin-bottom-17">
                                    <div class='arrow_box' style='width: 94%; height: 200px;'>
                                        <p class='pagseguro-p'>Precisamos saber qual o banco que a transação será realizada</p> <hr />
                                        <div class="col-lg-5 div-center">
                                            <label>Selecione o banco</label>
                                            <select name='bankName' class='form-control selectpicker'>
                                                <option value='itau'>Itaú</option>
                                                <option value='bradesco'>Bradesco</option>
                                                <option value='bancodobrasil'>Banco do Brasil</option>
                                                <option value='banrisul'>Banrisul</option>
                                                <option value='hsbc'>HSBC</option>
                                            </select>
                                        </div>                                    
                                    </div>
                                </div>
                            </div>                             
                            <div class='col-lg-12 field-boleto'>
                                <div class="col-lg-12 margin-bottom-17">
                                    <div class='arrow_box' style='width: 94%; height: 200px;'>
                                        <p class='pagseguro-p'>Isso é tudo que precisamos por enquanto</p> <hr />
                                        <p class='pagseguro-p'>Seus dados estão corretos ?</p>
                                        <p class='pagseguro-p-2'>Clique para prosseguir com a venda</p>
                                        <br />
                                        <p class='pagseguro-p'>Quer revisar seus dados?</p>
                                        <p class='pagseguro-p-2'>Clique no botão voltar e fique a vontade :)</p>
                                    </div>
                                </div>
                            </div>                            
                            <div class='col-lg-12 field-cartao-credito'>
                                <div class="col-lg-6 margin-bottom-17">
                                    <label>Número do cartão</label>
                                    <div class="input-group">
                                        <input type='text' class='form-control' name='numCartao' id='numCartao' />
                                        <span class="input-group-addon" id="sizing-addon2"><img id='imagemCartao' src='{url}assets/images/bandeira.png' /></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 margin-bottom-17">
                                    <label style='float: left; width: 100%;'>Data de validade</label>
                                    <input type='text' class='form-control' name='mes' maxlength='2' id='mes' placeholder="MM" style='width: 50px; float: left;' />
                                    <input type='text' class='form-control' name='ano' maxlength='2' id='ano' placeholder="AA" style='width: 50px; float: left; margin-left: 20px;' />
                                </div>
                                <div class="col-lg-6 margin-bottom-17">
                                    <label>Nome do dono do cartão</label>
                                    <input type='text' class='form-control' name='donoCartao' id='donoCartao' value='Adão Duque' />
                                </div>
                                <div class="col-lg-4 margin-bottom-17">
                                    <label style='float: left; width: 100%;'>Código de segurança (CVV)</label>
                                    <input type='text' class='form-control' name='codigoSeguranca' id='codigoSeguranca' required maxlength="3" style='width: 120px; float: left;' />
                                </div>
                                <div class="col-lg-6 margin-bottom-17">
                                    <label>Parcele em até 18x</label>
                                    <select class='form-control selectpicker' id='parcelas' name='parcelas'>
                                        <option value=''>...</option>
                                    </select>
                                </div>
                              <div class="col-lg-4 margin-bottom-17">
                                    <label style='float: left; width: 100%;'>Data Nasc. do dono do cartão</label>
                                    <input type='text' class='form-control' name='dataNascDono' id='dataNascDono' value='27/10/1989' required style='width: 120px; float: left;' />
                                </div>
                            </div>
                        </div>
                        <input type='hidden' name='idEndereco' id='idEndereco' />
                        <input type='hidden' name='senderHash' id='senderHash' />
                        <input type='hidden' name='cardToken' id='cardToken' />
                        <input type='hidden' name='parcelaValor' id='parcelaValor' />
                        <input type='hidden' name='parcelasSemJuros' id='parcelasSemJuros' value='10' />
                        <input type='hidden' name='gateway' id='gateway' value='1' />
                    </form>
                </div>
            </div>
            <div class="modal-footer modal-footer-pagseguro">
                <div class='message-container alert alert-danger no-border absolute width-all no-radius text-align-left hidden' style='height: 50px;'>
                
                </div>
                <div class='margin-10 footer-modal-buttons'>
                    <button type="button" class="btn btn-success voltar">Voltar</button>
                    <button type="button" class="btn btn-success prosseguir">Prosseguir</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->