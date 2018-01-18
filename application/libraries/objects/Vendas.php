<?php 

namespace objects;

use objects\Vendas;

use extend;

use db;

if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

date_default_timezone_set('America/Sao_Paulo');

class Vendas extends db\Querys  {

    public $General        =  null;

    public $Dates          =  null;

    public $referencia     =  null;

    public $idUsuario      =  null;

    public $idEndereco     =  null;

    public $idVenda        =  null;

    public $idVendaPs      =  null;

    public $idGateway      =  null;

    public $idProduto      =  null;

    public $idFrete        =  null;

    public $total          =  null;

    public $codeTrans      =  null;

    public $dataTrans      =  null;

    public $date           =  null;

    public $status         =  null;

    public $tpTrans        =  null;

    public $meioPag        =  null;

    public $codeRastreio   =  null;

    /**
    * Método iniciliza a classe de vendas
    *
    * @return VOID
    * @access PUBLIC
    */
    public function __contruct() { }


    /**
    * Método grava um log de notificação
    * @param  STRING  $ip          -  IP de quem acessou o sistema
    * @param  STRING  $codeNotify  -  Código da notificação
    * @return VOID
    * @access PUBLIC
    */
    public function gravarLogNotificacao( $ip, $codeNotify ) {

        $gravar                  =    array(

            "lognotps_ip"        =>   $ip,

            "lognotps_code"      =>   $codeNotify,

            "ven_id"             =>   $this->idVenda,

            "lognotps_cadastro"  =>   date( 'Y-m-d H:i:s' ),
        );

        $this->table  =  'log_notificacoes_pagseguro';

        //Grava o log
        $this->insert( $gravar );       

    }


    /**
    * Método grava a informação de frete
    * @param  STRING  $valorFrete  -  Valor total do frete
    * @param  STRING  $cobrado     -  FLAG que determina se o frete foi ou não cobrado. ex: 0 => não, 1 => Sim
    * @return VOID
    * @access PUBLIC
    */
    public function gravarFrete( $valorFrete, $cobrado ) {

        $gravar            =    array(

            'fre_valor'    =>   $valorFrete,

            'ven_id'       =>   $this->idVenda,

            'fre_cobrado'  =>   $cobrado

        );

        $this->table  =  'frete';

        //Grava o log
        $this->insert( $gravar );       

    }


    /**
    * Método grava a informação de frete
    * @param  STRING  $valor  -  Valor do frete para o determinado produto
    * @return VOID
    * @access PUBLIC
    */
    public function gravarFreteProdutos( $valor ) {

        $gravar            =    array(

            'prod_id'      =>   $this->idProduto,

            'fre_id'       =>   $this->idFrete,

            'frepro_valor' =>   $valor

        );

        $this->table  =  'frete_produtos_ass';

        //Grava o log
        $this->insert( $gravar );       

    }


    /**
    * Método grava um log de erro ao efetuar o pagamento
    * @param  STRING  $ip       -  IP de quem acessou o sistema
    * @param  STRING  $message  -  Mensagem de erro
    * @param  STRING  $code     -  Código do erro
    * @return VOID
    * @access PUBLIC
    */
    public function gravarLogErrorNotificacao( $ip, $message, $code ) {

        $gravar                 =    array(

            "erra_ip"           =>   $ip,

            "erra_message"      =>   $message,

            "erra_code_venda"   =>   $this->codeTrans,

            "erra_code"         =>   $code,

            "erra_cadastro"     =>   date( 'Y-m-d H:i:s' )

        );

        $this->table  =  'log_error_atualizacoes';

        //Grava o log
        $this->insert( $gravar );       

    }


    /**
    * Método grava um log de erro ao efetuar o pagamento
    * @param  STRING  $message  -  Mensagem de erro
    * @param  INT     $code     -  Código do erro. (Erro código: 0000 => Pagseguro não retornou um XML válido)
    * @param  INT     $status   -  Status do erro: 0 => Em aberto, 1 => Solucionado
    * @return VOID
    * @access PUBLIC
    */
    public function gravarLogError( $message, $code, $status ) {

        $gravar                =    array(

            "ven_id"           =>   $this->idVenda,

            "usu_id"           =>   $this->idUsuario,

            "gatw_id"          =>   $this->idGateway,

            "err_code"         =>   $code,

            "err_message"      =>   $message,

            "err_status"       =>   $status,

            "err_cadastro"     =>   date( 'Y-m-d H:i:s' )

        );

        $this->table  =  'log_error_vendas';

        //Grava o log
        $this->insert( $gravar );       

    }


    /**
    * Método retorna o LINK de acesso ao boleto (PAGSEGURO)
    *
    * @param  NULL
    * @return STRING
    * @access PUBLIC
    */
    public function getLinkBoleto() {

        //retorna o link
        return $this->dataTrans['paymentLink'];

    }


    /**
    * Método seta o array que é retornado ao fim de uma transação (PAGSEGURO)
    *
    * @param  ARRAY  $data  -  Array que contém os dados do retorno da transação
    * @return VOID
    * @access PUBLIC
    */
    public function setDataReturnTransaction( $data = array() ) {

        $this->dataTrans  =  $data;

    }


    /**
    * Método prepara os dados que serão gravados na venda do pagseguro
    *
    * @param  NULL
    * @return VOID
    * @access PUBLIC
    */
    public function prepararVendaPagseguro() {

        //Obtem a data da transação
        $this->date        =   $this->dataTrans['date'];

        //Obtem o código do pagseguro sem os separadores com hífen
        $this->codeTrans   =   preg_replace( '/-/', '', $this->dataTrans['code'] );

        //Obtem a referencia do pagamento
        $this->referencia  =   $this->dataTrans['reference'];        

        //Obtem o status do pagamento
        $this->status      =   $this->dataTrans['status'];

        //Obtem o tipo de transação
        $this->tpTrans     =   $this->dataTrans['type'];

        //Obtem o código do meio de pagamento
        $this->meioPag     =   $this->dataTrans['paymentMethod']['code'];

    }


    /**
    * Método grava a venda do pagseguro
    *
    * @param  BOOL $update  - Condição para atualizar os registros
    * @return VOID
    * @access PUBLIC
    */
    public function gravarVendaPagseguro( $update = false ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar               =    array(

            "ven_id"          =>   $this->idVenda,

            "tptransps_id"    =>   $this->tpTrans,  

            "idemeiopagps_id" =>   $this->meioPag,

            "statransps_id"   =>   $this->status,

            "venps_code"      =>   $this->codeTrans,

            "venps_cadastro"  =>   date( 'Y-m-d H:i:s' ),

            "venps_update"    =>   $this->date

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            //Remove os campos que estão vazios
            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        //Seta a tabela que os dados serão gravados
        $this->table =  'vendas_ps';

        //Verifica se a condição de atualização
        if( !$update ) {
            
            //Grava a venda
            $this->insert( $gravar );

        }else {

            //Remove alguns campos
            unset( $gravar['ven_id'] );

            unset( $gravar['venps_code'] );

            unset( $gravar['venps_cadastro'] );

            //Seta a condição de atualização pelo código da transação
            $this->setWhere( "venps_code = '$this->codeTrans'" );

            //Seta a condição de atualização pelo ID da venda
            $this->setWhere( "venps_id = '$this->idVendaPs'" );

            //Atualiza os dados
            $this->update( $gravar );

        }

    }


    /**
    * Método grava ou atualiza um título de lista
    *
    * @param  INT    $status  -  ID do status da venda
    * @param  FLOAT  $valor   -  Valor da venda
    * @param  BOOL   $update  -  Condicao de atualização
    * @return VOID
    * @access PUBLIC
    */
    public function gravarVenda( $status, $valor, $servico, $update = false, $admin = false ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar       =   array(

            "usu_id"         =>   $this->idUsuario,

            "end_id"         =>   $this->idEndereco,

            "gatw_id"        =>   $this->idGateway,

            "staven_id"      =>   $status,

            "servent_id"     =>   $servico,

            "ven_referencia" =>   $this->referencia,

            "ven_valor"      =>   $valor,

            "ven_rastreio"   =>   $this->codeRastreio,

            "ven_cadastro"   =>   date( 'Y-m-d H:i:s' )

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            //Remove os campos que estão vazios
            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        //Seta a tabela que os dados serão gravados
        $this->table =  'vendas';

        //Verifica se a condição de atualização
        if( !$update ) {
            
            //Grava a venda
            $this->insert( $gravar );

        }else {

            //Remove alguns campos
            unset( $gravar['gatw_id'] );

            unset( $gravar['usu_id'] );

            unset( $gravar['ven_cadastro'] );

            //Seta a condição de atualização pela referencia
            $this->setWhere( "ven_referencia = '$this->referencia'" );

            //Seta a condição de atualização pelo ID do usuário
            !$admin ? $this->setWhere( "usu_id = '$this->idUsuario'" ) : null;

            //Atualiza os dados
            $this->update( $gravar );

        }

    }


    /**
    * Método grava os produtos na tabela associativa de vendas
    *
    * @param  INT    $qtd    -  Quantidade do produto
    * @param  FLOAT  $valor  -  Valor do produto
    * @param  BOOL   $update -  Condicao de atualização
    * @return VOID
    * @access PUBLIC
    */
    public function gravarProdutosVenda( $qtd, $valor, $update = false ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar       =   array(

            "ven_id"             =>   $this->idVenda,

            "prod_id"            =>   $this->idProduto,

            "venprodass_valor"   =>   $valor,

            "venprodass_qtd"     =>   $qtd,

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            //Remove os campos que estão vazios
            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        //Seta a tabela que os dados serão gravados
        $this->table =  'vendas_produtos_ass';

        //Verifica se a condição de atualização
        if( !$update ) {
            
            //Grava os dados da venda
            $this->insert( $gravar );

        }else {

            //Remove alguns campos
            unset( $gravar['ven_id'] );

            unset( $gravar['prod_id'] );

            //Seta a condição de atualização pelo ID da venda
            $this->setWhere( "ven_id  = '$this->idVenda'" );

            //Seta a condição de atualização pelo ID do produto
            $this->setWhere( "prod_id = '$this->idProduto'" );

            //Atualiza os dados
            $this->update( $gravar );

        }

    }


    /**
    * Método obtem o ID da venda se baseando no ID do usuário e na referencia da venda
    *
    * @param  INT  $idPromocao  -   ID da promocao 
    * @param  BOOL $update      -   Condicao de atualização
    * @return VOID
    * @access PUBLIC
    */
    public function gravarPromocaoVenda( $idPromocao, $update = false) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar       =   array(

            "ven_id"             =>   $this->idVenda,

            "promo_id"           =>   $idPromocao,

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            //Remove os campos que estão vazios
            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        //Seta a tabela que os dados serão gravados
        $this->table =  'vendas_promocoes_ass';

        //Verifica se a condição de atualização
        if( !$update ) {
            
            //Grava os dados da venda
            $this->insert( $gravar );

        }else {

            //Remove alguns campos
            unset( $gravar['ven_id'] );

            //Seta a condição de atualização pelo ID da venda
            $this->setWhere( "ven_id  = '$this->idVenda'" );

            //Seta a condição de atualização pelo ID da promocao
            $this->setWhere( "promo_id = '$idPromocao'" );

            //Atualiza os dados
            $this->update( $gravar );

        }

    }


    /**
    * Método obtem o ID da venda do pagseguro
    *
    * @param  NULL
    * @return BOOL
    * @access PUBLIC
    */
    public function getIDVendaPagseguro() {

        //Reseta os atributos de Querys
        $this->reset();

        //Seta o campo que deseja retorna
        $this->setField( 'venps_id' );

        //Seta a condição de busca pela referencia
        $this->setWhere( "venps_code = '$this->codeTrans'" );

        //Seta a tabela
        $this->table   =   'vendas_ps';

        //Obtem o ID da venda
        $id   =   $this->getRecord();

        //Verifica se o retorno é booleano, se sim, ocorreu algum erro
        if( is_bool( $id ) ) {

            //Retturn false
            return false;

        }else {

            //recebe o ID da venda
            $this->idVendaPs  =   $id;

            //Retturn true
            return true;

        }

    }

    
    /**
    * Método obtem o ID da venda se baseando no ID do usuário e na referencia da venda
    *
    * @param  NULL
    * @return BOOL
    * @access PUBLIC
    */
    public function getIDVenda() {

        //Reseta os atributos de Querys
        $this->reset();

        //Seta o campo que deseja retorna
        $this->setField( 'ven_id' );

        //Seta a condição de busca pela referencia
        $this->setWhere( "ven_referencia = '$this->referencia'" );

        //Seta a condição de busca pelo ID do usuário
        $this->setWhere( "usu_id = '$this->idUsuario'" );

        //Seta a tabela
        $this->table   =   'vendas';

        //Obtem o ID da venda
        $id   =   $this->getRecord();

        //Verifica se o retorno é booleano, se sim, ocorreu algum erro
        if( is_bool( $id ) ) {

            //Retturn false
            return false;

        }else {

            //recebe o ID da venda
            $this->idVenda  =   $id;

            //Retturn true
            return true;

        }

    }


    /**
    * Método obtem a referencia com base no ID da venda
    *
    * @param  NULL
    * @return VOID
    * @access PUBLIC
    */
    public function getReferenciaByVenda() {

        //Reseta os atributos de Querys
        $this->reset();

        //Seta o campo que deseja retorna
        $this->setField( 'ven_referencia' );

        //Seta a condição de busca pela referencia
        $this->setWhere( "ven_id = '$this->idVenda'" );

        //Seta a tabela
        $this->table        =   'vendas';

        //Obtem o ID da venda
        $this->referencia   =   $this->getRecord();

    }


    /**
    * Método obtem o ID da venda se baseando no ID do usuário e na referencia da venda
    *
    * @param  NULL
    * @return BOOL
    * @access PUBLIC
    */
    public function vendaExists() {

        //Reseta os atributos de Querys
        $this->reset();

        //Seta o campo que deseja retorna
        $this->setField( 'ven_id' );

        //Seta a condição de busca pela referencia
        $this->setWhere( "ven_id = '$this->idVenda'" );

        //Seta a tabela
        $this->table   =   'vendas';

        //Obtem o ID da venda
        return $this->searchRecord();

    }


    /**
    * Método obtem o ID do frete com base no ID da venda
    *
    * @param  NULL
    * @return VOID
    * @access PUBLIC
    */
    public function getIdFrete() {

        //Reseta os atributos de Querys
        $this->reset();

        //Seta o campo que deseja retorna
        $this->setField( 'fre_id' );

        //Seta a condição de busca pelo ID do usuário
        $this->setWhere( "ven_id = '$this->idVenda'" );

        //Seta a tabela
        $this->table   =   'frete';

        //Obtem o ID da venda
        $id   =   $this->getRecord();

        //recebe o ID da venda
        $this->idFrete  =   $id;

    }    


    /**
    * Método obtem o ID do usuário com base na referencia da venda
    *
    * @param  NULL
    * @return BOOL
    * @access PUBLIC
    */
    public function getIDUsuario() {

        //Reseta os atributos de Querys
        $this->reset();

        //Seta o campo que deseja retorna
        $this->setField( 'usu_id' );

        //Seta a condição de busca pela referencia
        $this->setWhere( "ven_referencia = '$this->referencia'" );

        //Seta a tabela
        $this->table   =   'vendas';

        //Obtem o ID da venda
        $id   =   $this->getRecord();

        //Verifica se o retorno é booleano, se sim, ocorreu algum erro
        if( is_bool( $id ) ) {

            //Retturn false
            return false;

        }else {

            //recebe o ID da venda
            $this->idUsuario  =   $id;

            //Retturn true
            return true;

        }

    }


    /**
    * Método obtem o ID do endereço da venda
    *
    * @param  NULL
    * @return BOOL
    * @access PUBLIC
    */
    public function getIDEndereco() {

        //Reseta os atributos de Querys
        $this->reset();

        //Seta o campo que deseja retorna
        $this->setField( 'end_id' );

        //Seta a condição de busca pela referencia
        $this->setWhere( "ven_referencia = '$this->referencia'" );

        //Seta a tabela
        $this->table   =   'vendas';

        //Obtem o ID do endereco
        $this->idEndereco  =  $this->getRecord();

    }

    /**
    * Método obtem o ID do usuário com base na referencia da venda
    *
    * @param  NULL
    * @return BOOL
    * @access PUBLIC
    */
    public function getCodeRastreio() {

        //Reseta os atributos de Querys
        $this->reset();

        //Seta o campo que deseja retorna
        $this->setField( 'ven_rastreio' );

        //Seta a condição de busca pela referencia
        $this->setWhere( "ven_id = '$this->idVenda'" );

        //Seta a tabela
        $this->table          =   'vendas';

        //Obtem o ID da venda
        $this->codeRastreio   =   $this->getRecord();

    }


    /**
    * Método gera uma referencia unica para a venda, seta a referencia unica no atributo referencia
    *
    * @param  NULL
    * @return VOID
    * @access PUBLIC
    **/
    public function gerarReferencia() {

        $this->General   =   new extend\General();

        $condition       =   false;

        while( !$condition ) {

            $this->referencia  =  $this->General->generateNumberRandom();

            $condition         =  $this->referenceExists() ? false : true;

        }

    }


    /**
    * Método verifica se uma referencia existe em banco de dados
    *
    * @param  NULL
    * @return BOOL
    * @access PUBLIC
    **/
    public function referenceExists() {

        $this->reset();

        $this->setField( 'ven_referencia' );

        $this->setWhere( "ven_referencia = '$this->referencia'" );

        $this->table  =  'vendas';

        return $this->searchRecord();

    }


    /**
    * Método obtem todas as compras do usuário, serão retornadas apenas 10 vendas por vez
    *
    * @param  INT $ini  -   Quantidade inicial de busca
    * @param  INT $end  -   Quantidade final de busca
    * @return ARRAY
    * @access PUBLIC
    */
    public function getCompras( $ini = '', $end = '' ) {

        //Reseta os atributos de Querys
        $this->reset();

        //Instancia a classe de datas
        $this->Dates   =   new extend\Dates();

        //inicializa o array que vamos retornar
        $result        =   array();

        //inicializa o array que vamos obter os dados da consulta
        $data          =   array();

        //Seta o campo que deseja retorna
        $this->setField( 'VEN.ven_id, fre_valor, fre_cobrado, ven_referencia, staven_descricao, ven_valor, ven_cadastro' );

        //Seta o JOIN entre as tabelas vendas e status da venda
        $this->setJoin( 'INNER JOIN status_venda AS STAVEN ON STAVEN.staven_id = VEN.staven_id' );

        //Seta o JOIN entre as tabelas vendas e frete
        $this->setJoin( 'INNER JOIN frete AS FRE ON FRE.ven_id = VEN.ven_id' );

        //Seta a condição de busca pelo ID do usuário
        $this->setWhere( "usu_id = '$this->idUsuario'" );

        //Seta a tabela
        $this->table   =   'vendas AS VEN';

        //Obtem o ID da venda
        $data          =   $this->get();

        if( count( $data ) > 0 ) {

            //Nosso contador
            $i  =  0;

            //Extraindo os dados
            foreach ( $data as $key ) {

                //Seta o ID da venda
                $result[$i]['valu']   =   $key->ven_id;

                //Seta a referencia da venda
                $result[$i]['refe']   =   $key->ven_referencia;

                //Seta o status da venda
                $result[$i]['stat']   =   $key->staven_descricao;

                //Seta o valor da venda
                $result[$i]['valo']   =   number_format( $key->ven_valor, 2, ',', '.');

                //Seta o valor da venda
                $result[$i]['fret']   =   $key->fre_cobrado == 1 ? number_format( $key->fre_valor, 2, ',', '.') : '0,00';

                //Seta a data da venda
                $result[$i]['data']   =   $this->Dates->format( $key->ven_cadastro, 'd/m/Y H:i' );

                //Incrementa o contador
                $i++;

            }

        }

        //Retorna os dados
        return $result;

    }


    /**
    * Método obtem todas as compras do usuário, serão retornadas apenas 10 vendas por vez
    *
    * @param  INT $ini  -   Quantidade inicial de busca
    * @param  INT $end  -   Quantidade final de busca
    * @return ARRAY
    * @access PUBLIC
    */
    public function getVendas( $ini = 10, $end = 10 ) {

        //Reseta os atributos de Querys
        $this->reset();

        //Instancia a classe de datas
        $this->Dates   =   new extend\Dates();

        //inicializa o array que vamos retornar
        $result        =   array();

        //inicializa o array que vamos obter os dados da consulta
        $data          =   array();

        //Seta o campo que deseja retorna
        $this->setField( 'VEN.ven_id, usu_nome, usu_sobrenome, gatw_nome, fre_valor, fre_cobrado, ven_referencia, staven_descricao, ven_valor, ven_cadastro' );

        //Seta o JOIN entre as tabelas vendas e status da venda
        $this->setJoin( 'INNER JOIN status_venda AS STAVEN ON STAVEN.staven_id = VEN.staven_id' );

        //Seta o JOIN entre as tabelas vendas e status da venda
        $this->setJoin( 'INNER JOIN usuarios AS USU ON USU.usu_id = VEN.usu_id' );

        //Seta o JOIN entre as tabelas vendas e frete
        $this->setJoin( 'INNER JOIN frete AS FRE ON FRE.ven_id = VEN.ven_id' );

        //Seta o JOIN entre as tabelas vendas e frete
        $this->setJoin( 'INNER JOIN gateway AS GAT ON GAT.gatw_id = VEN.gatw_id' );

        //Agrupando por ID da venda
        $this->setClausula( 'GROUP BY VEN.ven_id' );

        //Agrupando por ID da venda
        $this->setClausula( 'ORDER BY VEN.ven_id DESC ' );

        //Seta a tabela
        $this->table   =   'vendas AS VEN';

        //Obtem o ID da venda
        $data          =   $this->get();

        if( count( $data ) > 0 ) {

            //Nosso contador
            $i  =  0;

            //Extraindo os dados
            foreach ( $data as $key ) {

                //Seta o ID da venda
                $result[$i]['valu']   =   $key->ven_id;

                //Seta a referencia da venda
                $result[$i]['refe']   =   $key->ven_referencia;

                //Seta a referencia da venda
                $result[$i]['usua']   =   $key->usu_nome . ' ' . $key->usu_sobrenome;

                //Seta o status da venda
                $result[$i]['stat']   =   $key->staven_descricao;

                //Seta o valor da venda
                $result[$i]['valo']   =   number_format( $key->ven_valor, 2, ',', '.');

                //Seta o valor da venda
                $result[$i]['gatw']   =   $key->gatw_nome;

                //Seta o valor da venda
                $result[$i]['fret']   =   $key->fre_cobrado == 1 ? number_format( $key->fre_valor, 2, ',', '.') : '0,00';

                //Seta a data da venda
                $result[$i]['data']   =   $this->Dates->format( $key->ven_cadastro, 'd/m/Y H:i:s' );

                //Incrementa o contador
                $i++;

            }

        }

        //Retorna os dados
        return $result;

    }


    /**
    * Método obtem o tipo de servico
    *
    * @param  INT   NULL
    * @return STRING
    * @access PUBLIC
    */
    public function getServico() {

        //Reseta os atributos de Querys
        $this->reset();

        //Seta o campo que deseja retorna
        $this->setField( 'servent_descricao' );

        $this->setJoin( 'INNER JOIN servico_entrega AS SERVENT ON SERVENT.servent_id = VEN.servent_id' );

        $this->setWhere( "ven_id = '$this->idVenda'" );

        //Seta a tabela
        $this->table   =  'vendas AS VEN';

        //Retorna os dados
        return $this->getRecord();

    }


    /**
    * Método obtem o tipo de servico
    *
    * @param  INT $servico  -   ID do tipo de servico
    * @return STRING
    * @access PUBLIC
    */
    public function getCodeServicoEntrega( $idServico ) {

        //Reseta os atributos de Querys
        $this->reset();

        //Seta o campo que deseja retorna
        $this->setField( 'servent_code' );

        //Seta a condição de busca
        $this->setWhere( "servent_id = '$idServico'" );

        //Seta a condição de busca
        $this->setWhere( "servent_status = 1" );

        //Seta a tabela
        $this->table   =  'servico_entrega';

        //Retorna os dados
        return $this->getRecord();

    }


    /**
     * Método obtem todos os produtos de uma compra
     *
     * @param  NULL
     * @return ARRAY
     * @access PUBLIC
     */
    public function getProdutosCompra() {

        //Reseta os atributos de Querys
        $this->reset();

        //inicializa o array que vamos retornar
        $result        =   array();

        //inicializa o array que vamos obter os dados da consulta
        $data          =   array();

        //Seta o campo que deseja retorna
        $this->setField( 'prod_nome, prod_codigo, venprodass_valor, venprodass_qtd' );

        //Seta o JOIN entre as tabelas vendas e status da venda
        $this->setJoin( 'INNER JOIN vendas_produtos_ass AS VENPRO ON VENPRO.prod_id = PROD.prod_id' );

        //Seta a condição de busca pelo ID do usuário
        $this->setWhere( "ven_id = '$this->idVenda'" );

        //Seta uma clausula
        $this->setClausula( "GROUP BY PROD.prod_id" );

        //Seta a tabela
        $this->table   =   'produtos AS PROD';

        //Realiza a consulta
        $data          =   $this->get();

        //Verifica se algo foi retornado
        if( count( $data ) > 0 ) {

            //Contador
            $i  =  0;

            //Extraindo os dados
            foreach ( $data as $key ) {
                
                //Recebe o nome
                $result[$i]['name']  =  $key->prod_nome;

                //Recebe o código
                $result[$i]['code']  =  $key->prod_codigo;

                //Recebe a quantidade
                $result[$i]['qtd']   =  $key->venprodass_qtd;

                //Recebe o valor
                $result[$i]['valo']  =  number_format( $key->venprodass_valor, 2, ',', '.' );

                //Incrementa o contador
                $i++;

            }

        }

        return $result;

    }


    /**
     * Método obtem todos os produtos de uma compra
     *
     * @param  NULL
     * @return ARRAY
     * @access PUBLIC
     */
    public function getEnderecoVenda() {


    }


    /**
    * Método obtem todos os detalhes de uma determinada venda
    *
    * @param  NULL
    * @return ARRAY
    * @access PUBLIC
    */
    public function getDetalheCompra() {

        //Reseta os atributos de Querys
        $this->reset();

        //Instancia a classe de datas
        $this->Dates   =   new extend\Dates();

        //inicializa o array que vamos retornar
        $result        =   array();

        //inicializa o array que vamos obter os dados da consulta
        $data          =   array();

        //Seta o campo que deseja retorna
        $this->setField( 'ven_id, ven_referencia, staven_descricao, ven_valor, ven_cadastro' );

        //Seta o JOIN entre as tabelas vendas e status da venda
        $this->setJoin( 'INNER JOIN status_venda AS STAVEN ON STAVEN.staven_id = VEN.staven_id' );

        //Seta a condição de busca pelo ID do usuário
        $this->setWhere( "usu_id = '$this->idUsuario'" );

        //Seta a condição de busca pelo ID do usuário
        $this->setWhere( "ven_referencia = '$this->referencia'" );

        //Seta a tabela
        $this->table   =   'vendas AS VEN';

        //Obtem o ID da venda
        $data          =   $this->get();

        if( count( $data ) > 0 ) {

            //Nosso contador
            $i  =  0;

            //Extraindo os dados
            foreach ( $data as $key ) {

                //Seta o ID da venda
                $result[$i]['valu']   =   $key->ven_id;

                //Seta a referencia da venda
                $result[$i]['refe']   =   $key->ven_referencia;

                //Seta o status da venda
                $result[$i]['stat']   =   $key->staven_descricao;

                //Seta o valor da venda
                $result[$i]['valo']   =   number_format( $key->ven_valor, 2, ',', '.');

                //Seta a data da venda
                $result[$i]['data']   =   $this->Dates->format( $key->ven_cadastro, 'd/m/Y H:i' );

                //Incrementa o contador
                $i++;

            }

        }

        //Retorna os dados
        return $result;

    }


}







