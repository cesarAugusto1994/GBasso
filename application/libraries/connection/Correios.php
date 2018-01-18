<?php 

namespace connection {

    use connection;

    use parser;

    if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

    /**
    *  Essa classe realiza chamadas usando o método CURL
    *
    **/
    class Correios extends Curl {

        /**
         * endereço do webservice dos correios
         */
        public    $urlCorreios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx";

        /**
         * Código de rastreio de uma encomenda
         */
        private   $codeRastreio  =  null;

        /**
         * Seu código administrativo junto à ECT.
         * O código está disponível no corpo do contrato firmado com os Correios.
         */
        protected $nCdEmpresa = '';


        /**
         * Senha para acesso ao serviço, associada ao seu código administrativo.
         */
        protected $sDsSenha = '';


        /**
         * Código do serviço
         * 41106 PAC sem contrato
         * 40010 SEDEX sem contrato
         * 40045 SEDEX a Cobrar, sem contrato
         * 40215 SEDEX 10, sem contrato
         * 40290 SEDEX Hoje, sem contrato
         * 40096 SEDEX com contrato
         * 40436 SEDEX com contrato
         * 40444 SEDEX com contrato
         * 81019 e-SEDEX, com contrato
         * 41068 PAC com contrato
         */
        protected $nCdServico = '40215';


        /**
         * Cep de origem sem o dígito
         * @example 05311900
         */
        protected $sCepOrigem = '08346575';


        /**
         *  CEP de Destino Sem hífem
         * @example 05311900
         */
        protected $sCepDestino = '01046010';


        /**
         * Peso da encomenda, incluindo sua embalagem. 
         * O peso deve ser informado em quilogramas.
         */
        protected $nVlPeso = '';


        /**
         * Formato da encomenda (incluindo embalagem).
         * Valores possíveis: 1 2, e 3
         * 1 ? Formato caixa/pacote
         * 2 ? Formato rolo/prisma
         * 3 ? Formato envelope
         */
        protected $nCdFormato = "1";


        /**
         * Comprimento da encomenda (incluindo embalagem), em centímetros.
         * É obrigatório somente para PAC
         */
        protected $nVlComprimento = '';


        /**
         * Altura da encomenda (incluindo embalagem), em centímetros.
         * É obrigatório somente para PAC
         */
        protected $nVlAltura = '';


        /**
         * Largura da encomenda (incluindo embalagem), em centímetros.
         * É obrigatório somente para PAC
         */
        protected $nVlLargura = '';


        /**
         * Diâmetro da encomenda (incluindo embalagem), em centímetros.
         * É obrigatório somente para PAC
         */
        protected $nVlDiametro = "";


        /**
         * Indica se a encomenda será entregue com o serviço adicional mão própria.
         * Valores possíveis: S ou N (S = Sim, N = Não)
         */
        protected $sCdMaoPropria = "N";


        /**
         * Indica se a encomenda será entregue com o serviço 
         * adicional valor declarado.
         * Neste campo deve ser apresentado o valor declarado desejado, em Reais.
         * Se não optar pelo serviço informar zero.
         */
        protected $nVlValorDeclarado = "0";


        /**
         * Indica se a encomenda será entregue com o serviço 
         * adicional aviso de recebimento.
         * Valores possíveis: S ou N (S = Sim, N = Não)
         */
        protected $sCdAvisoRecebimento = "N";


        /**
         * Indica a forma de retorno da consulta.
         * XML: Resultado em XML
         * Popup:  Resultado em uma janela popup
         * <URL>: Resultado via post em uma página do requisitante
         */
        protected $StrRetorno = "xml";

        protected $DomParser   = null;


        /**
         * Método inicia a classe de Correios e inicializa o Curl
         * 
         * @param  NONE         
         * @return VOID
         * @access PUBLIC
         */        
        public function __construct() {

            //Inicializa o Curl
            $this->initCurl();

        }


        /**
         * SETTER único para todos os atributos da classe
         * 
         * @param  STRING $property  -  Nome do atributo
         * @param  STRING $value     -  Valor do atributo
         * @return VOID
         * @access PUBLIC
         */
        public function __set($property, $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }

        /**
         * GETTER único para todos os atributos da class
         * 
         * @param  STRING $name - Nome do atributo
         * @return VOID
         * @access PUBLIC
         */
        public function getValue($name) {
            return $this->$name;
        }


        /**
         * Calcula o diâmetro da encomenda em cm
         * 
         * @return VOID
         * @access PUBLIC
         */
        public function getDiametro() {
            $this->nVlDiametro = $this->nVlAltura + $this->nVlLargura;
        }


        /**
         * Prepara todos os dados que serão enviados ao correios para consulta
         *
         * @param  NULL
         * @return VOID
         * @access PUBLIC
         */
        public function prepareData() {

            //Prepara no array os dados que serão enviados ao correios
            $data   =   array(
                'nCdEmpresa'           =>   $this->nCdEmpresa,
                'sDsSenha'             =>   $this->sDsSenha,
                'nCdServico'           =>   $this->nCdServico,
                'sCepOrigem'           =>   $this->sCepOrigem,
                'sCepDestino'          =>   $this->sCepDestino,
                'nVlPeso'              =>   $this->nVlPeso,
                'nCdFormato'           =>   $this->nCdFormato,
                'nVlComprimento'       =>   $this->nVlComprimento,
                'nVlAltura'            =>   $this->nVlAltura,
                'nVlLargura'           =>   $this->nVlLargura,
                'nVlDiametro'          =>   $this->nVlDiametro = $this->nVlAltura + $this->nVlLargura,
                'sCdMaoPropria'        =>   $this->sCdMaoPropria,
                'nVlValorDeclarado'    =>   $this->nVlValorDeclarado,
                'sCdAvisoRecebimento'  =>   $this->sCdAvisoRecebimento,
                'StrRetorno'           =>   $this->StrRetorno
            );

            //Formata os dados do array para formato de parametro e valor para serem enviados no GET
            $param   =   $this->urlify( $data );

            //Concatena a URL com os parametros
            $url     =   $this->urlCorreios . '?' . $param;

            //Seta a URL na consulta
            $this->setOpt( 'CURLOPT_URL', $url );

            //Seta que a verificação de SSL não deve ser realizada
            $this->setOpt( 'CURLOPT_SSL_VERIFYPEER', 0 );

        }


        /**
         * Método retorna o status resultante da consulta ao correios
         *
         * @param  INT $error  -  Código do erro retornado na consulta
         * @return MIX STRING | BOOL
         * @access PUBLIC
         */
        public function getError( $error ) {

            switch ( $error ) {

                case '0': 
                    //Processado com sucesso
                    return false;
                break;
                case '-1': 
                    return 'Código de serviço inválido';
                break;
                case '-2': 
                    return 'CEP de origem inválido';
                break;
                case '-3': 
                    return 'CEP de destino inválido';
                break;
                case '-4': 
                    return 'Peso excedido';
                break;
                case '-5': 
                    return 'O Valor Declarado não deve exceder R$ 10.000,00';
                break;
                case '-6': 
                    return 'Serviço indisponível para o trecho informado';
                break;
                case '-7': 
                    return 'O Valor Declarado é obrigatório para este serviço';
                break;
                case '-8': 
                    return 'Este serviço não aceita Mão Própria';
                break;
                case '-9': 
                    return 'Este serviço não aceita Aviso de Recebimento';
                break;
                case '-10':
                    return 'Precificação indisponível para o trecho informado';
                break;
                case '-11':
                    return 'Para definição do preço deverão ser informados, também, o comprimento, a largura e altura do objeto em centímetros (cm).';
                break;
                case '-12':
                    return 'Comprimento inválido.';
                break;
                case '-13':
                    return 'Largura inválida.';
                break;
                case '-14':
                    return 'Altura inválida.';
                break;
                case '-15':
                    return 'O comprimento não pode ser maior que 105 cm.';
                break;
                case '-16':
                    return 'A largura não pode ser maior que 105 cm.';
                break;
                case '-17':
                    return 'A altura não pode ser maior que 105 cm.';
                break;
                case '-18':
                    return 'A altura não pode ser inferior a 2 cm.';
                break;
                case '-20':
                    return 'A largura não pode ser inferior a 11 cm.';
                break;
                case '-22':
                    return 'O comprimento não pode ser inferior a 16 cm.';
                break;
                case '-23':
                    return 'A soma resultante do comprimento + largura + altura não deve superar a 200 cm.';
                break;
                case '-24':
                    return 'Comprimento inválido.';
                break;
                case '-25':
                    return 'Diâmetro inválido';
                break;
                case '-26':
                    return 'Informe o comprimento.';
                break;
                case '-27':
                    return 'Informe o diâmetro.';
                break;
                case '-28':
                    return 'O comprimento não pode ser maior que 105 cm.';
                break;
                case '-29':
                    return 'O diâmetro não pode ser maior que 91 cm.';
                break;
                case '-30':
                    return 'O comprimento não pode ser inferior a 18 cm.';
                break;
                case '-31':
                    return 'O diâmetro não pode ser inferior a 5 cm.';
                break;
                case '-32':
                    return 'A soma resultante do comprimento + o dobro do diâmetro não deve superar a ';
                break;
                case '-33':
                    return 'Sistema temporariamente fora do ar. Favor tentar mais tarde.';
                break;
                case '-34':
                    return 'Código Administrativo ou Senha inválidos.';
                break;
                case '-35':
                    return 'Senha incorreta.';
                break;
                case '-36':
                    return 'Cliente não possui contrato vigente com os Correios.';
                break;

            }

        }


        /**
         * Comunica-se com os correios para obter os valores do frete
         * 
         * @param  NONE
         * @return ARRAY
         * @access PUBLIC
         */
        public function getFrete() {

            //Formata os parametros
            $this->prepareData();

            //Executa o curl e obtem o buffer da consulta
            $response  =  $this->execGetBuffer();

            //retorna os dados
            return $response;

        }


        /**
         * Método retorna os dados de rastreio de uma encomenda
         *
         * @param  NULL
         * @return ARRAY
         * @access PUBLIC
         */
        public function rastrear() {

            //Seta a URL de consulta
            $this->urlCorreios   =  'http://websro.correios.com.br/sro_bin/txect01$.QueryList?P_LINGUA=001&P_TIPO=001&P_COD_UNI=';

            //Seta o código de rastreamento junto a URL
            $this->urlCorreios  .=   $this->codeRastreio;

            //Inicializa o Curl
            $this->initCurl();

            //Seta a URl de consulta no Curl
            $this->setOpt( 'CURLOPT_URL', $this->urlCorreios );

            //Seta que não é necessário usar SSL
            $this->setOpt( 'CURLOPT_SSL_VERIFYPEER', 0 );

            //Seta o USER AGENT
            $this->setOpt( 'CURLOPT_USERAGENT', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:10.0) Gecko/20100101 Firefox/10.0' );

            //Seta que desejo o retorno da consulta
            $this->setOpt( 'CURLOPT_RETURNTRANSFER', true );

            //Executa o Curl e retorna os dados
            $data               =    $this->execute();  

            //Instancia a classe Dom Parser
            $this->DomParser    =    new parser\simple_html_dom();

            //Faz o load do html
            $table              =    $this->DomParser->load( $data );

            //Ininicializa o array que vai conter os dados da tabela de rastreamento
            $rows               =    array();

            //Inicializa o array que vai conter os dados do rastreio que serão retornados
            $data               =    array();

            //Hora de extrair da tabela suas TR's
            foreach( $table->find('tr') as $row ) {

                //Incializa o array que vai conter os dados da TR
                $tdText  =  array();

                //Hora de extrair dessa TR todos as TD
                foreach($row->find('td') as $cell) {

                    //Obtem o texto da TD
                    $tdText[] = $cell->plaintext;

                }

                //Atribui ao array os dados extraidos da TD
                $rows[] = $tdText;

            }

            //print_r( $rows ); exit;

            //Inicializa o contador de interações do looping
            $i     =  0;    

            //Inicializa o contador de indices do array principal
            $j     =  0;

            //Extraindo os dados
            foreach ($rows as $key => $value) {

                /**
                 * Verifica se o $i é maior que 0, pois o indice 0 é o texto Data, Local e Situação
                 * Verifica também se o $value contem 3 indices, pois as vezes o correios usa colspan e então buga o Simple html Dom
                 * O problema é o seguinte, imagine a tabela
                 * <table>
                 *      <tr><td>Data</td><td>Local</td><td>Situação</td></tr>
                 *       <tr rowspan="2">
                 *           <td>17/02/2016 07:10</td>
                 *           <td>CTE VILA MARIA - Sao Paulo/SP</td>
                 *           <td><font color="000000">Encaminhado</font></td>
                 *       </tr>
                 *       <tr>
                 *          <td colspan="2">Encaminhado para CEE VILA GUILHERME - Sao Paulo/SP</td>
                 *       </tr>                        
                 * <table>
                 * Desta forma a classe Simple Html Dom retorna o seguinte:
                 * array( 0 => array( 0 => '17/02/2016 07:10', 1 => 'CTE VILA MARIA - Sao Paulo/SP', 2 => 'Encaminhado' ),
                 *        1 => array( 0 => 'Encaminhado para CEE VILA GUILHERME - Sao Paulo/SP' )
                 *       )
                 *
                 * Creio que não era para ser assim, era para retornar o que tem no índice 0 e acrescentar o que tem no indice 1, desta forma:
                 * array( 0 => array( 0 => '17/02/2016 07:10', 1 => 'CTE VILA MARIA - Sao Paulo/SP', 2 => 'Encaminhado' ), 
                 *        1 => array( 0 => '17/02/2016 07:10', 1 => 'Encaminhado para CEE VILA GUILHERME - Sao Paulo/SP', 2 => 'Encaminhado' )
                 *       )
                 *
                 * A classe Simple Html Dom é perfeita, gosto muito dela, não sei como ela interpreta as TR com rowspan, mas da forma abaixo
                 * contorna o problema, então vamos continuar
                 */
                if( $i > 0 && count( $value ) == 3 ) {

                    //Prepara para atribuir os dados extraidos
                    $data[$j]  =  array(
                                      'data'      =>  htmlentities( trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $value[0])))),
                                      'local'     =>  htmlentities( trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $value[1])))),
                                      'situacao'  =>  htmlentities( trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $value[2]))))
                                  );  
                    //Incrementa o contador
                    $j++; 

                }else if( count( $value ) == 1 ) {

                    //Ao entrar aqui sabemos que é por causa do problema descrito acuma, não tem problema
                    $data[$j]  =  array(
                                      'data'      =>  htmlentities( trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $data[$j-1]['data'])))), //Obtem o valor do indice anterior
                                      'local'     =>  htmlentities( trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $rows[$key][0])))), //Obtem o valor corrente
                                      'situacao'  =>  htmlentities( trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $data[$j-1]['situacao']))))  //Obtem o valor do indice anterior
                                  );
                    //Incrementa o contador
                    $j++; 

                }

                //Incrementa o contador
                $i++;

            }

            //print_r( $data ); exit;

            //Retorna os dados
            return $data;

        }  

    }

}

















