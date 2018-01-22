<?php 

namespace objects;

use objects\Usuarios;

use db;

use extend;

if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

date_default_timezone_set('America/Sao_Paulo');

class Usuarios extends db\Querys  {

    public $Dates       =  null;

    public $idUsuario   =  null;

    public $email       =  null;

    public $cpf         =  null;

    public $cep         =  null;

    public $idEndereco  =  null;

    public function __contruct() { }


    /**
    * Método grava ou atualiza um título de lista
    * @param  STRING $nome       -   Nome do usuário
    * @param  STRING $sobrenome  -   Sobrenome do usuário
    * @param  STRING $sexo       -   Sexo do usuário
    * @param  STRING $dataNasc   -   Data de nascimento do usuário
    * @param  BOOL   $update     -   Condição para atualizar os dados do usuário
    * @return VOID
    * @access PUBLIC
    */
    public function gravarUsuario( $nome, $sobrenome, $sexo, $dataNasc, $update = false ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar   =   array(

            "usu_nome"         =>  $nome,

            "usu_sobrenome"    =>  $sobrenome,

            "usu_cpf"          =>  $this->cpf,

            "usu_sexo"         =>  $sexo,

            "usu_nascimento"   =>  $dataNasc,

            "usu_email"        =>  $this->email,

            "usu_cadastro"     =>  date( 'Y-m-d H:i:s' )

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        $this->table   =  'usuarios';

        if( !$update ) {
            
            $this->insert( $gravar );

            $this->getIDUsuario();

        }else {

            unset( $gravar['usu_cadastro'] );

            //Seta a condição da lista
            $this->setWhere( "usu_id = '$this->idUsuario'" );

            //Atualiza
            $this->update( $gravar );

        }

    }


    /**
    * Método grava ou atualiza um título de lista
    * @param  STRING $user    -   Usuario
    * @param  STRING $pass    -   Senha do usuário
    * @param  STRING $level   -   Nível do usuário
    * @param  STRING $status  -   Status do usuário
    * @param  BOOL   $update  -   Condição para atualizar os dados do usuário
    * @return VOID
    * @access PUBLIC
    */
    public function gravarLogin( $user, $pass, $level, $status, $update = false ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar   =   array(

            "usu_id"        =>  $this->idUsuario,

            "log_user"      =>  $user,

            "log_pass"      =>  $pass,

            "log_level"     =>  $level,

            "log_status"    =>  $status

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        $this->table   =  'login';

        if( !$update ) {
            
            $this->insert( $gravar );

        }else {

            unset( $gravar['usu_id'] );

            //Seta a condição da lista
            $this->setWhere( "usu_id = '$this->idUsuario'" );

            //Atualiza
            $this->update( $gravar );

        }

    }


    /**
    * Método grava ou atualiza um título de lista
    * @param  STRING $tpEndereco    -   Tipo de endereço
    * @param  STRING $destinatario  -   Nome do destinatário
    * @param  STRING $ptReferencia  -   Ponto de referência
    * @param  STRING $endereco      -   Endereço do usuário
    * @param  STRING $bairro        -   Bairro
    * @param  STRING $numero        -   Número
    * @param  STRING $complemento   -   Complemento
    * @param  STRING $referencia    -   Referencia do endereço
    * @param  BOOL   $update        -   Condição para atualizar os dados do endereço
    * @return VOID
    * @access PUBLIC
    */
    public function gravarEndereco( $tpEndereco = '', $destinatario, $ptReferencia,  $endereco = '', $bairro = '', $numero = '', $complemento = '', $principal = 0, $update = false ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar   =   array(

            "usu_id"           =>  $this->idUsuario,

            "tpend_id"         =>  $tpEndereco,

            "end_destinatario" =>  $destinatario,

            "end_cep"          =>  $this->cep,

            "end_endereco"     =>  $endereco,

            "end_bairro"       =>  $bairro,

            "end_numero"       =>  $numero,

            "end_complemento"  =>  $complemento,

            "end_referencia"   =>  $ptReferencia,

            "end_principal"    =>  $principal,

            "end_cadastro"     =>  date( 'Y-m-d H:i:s' )

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        $this->table   =  'enderecos';

        if( !$update ) {
            
            $this->insert( $gravar );

        }else {

            unset( $gravar['usu_id'] );

            unset( $gravar['tpend_id'] );

            //Seta a condição de atualização pelo ID do usuário
            $this->setWhere( "usu_id = '$this->idUsuario'" );

            //Seta a condição de atualização pelo cep
            $this->setWhere( "end_cep = '$this->cep'" );

            //Seta a condição da lista
            $this->setWhere( "end_id = '$this->idEndereco'" );

            //Atualiza
            $this->update( $gravar );

        }

    }


    /**
    * Método deleta um endereço
    * @param  NULL
    * @return VOID
    * @access PUBLIC
    */
    public function deletarEnderecos() {

        //Reseta os attr de querys
        $this->reset();

        //Seta a tabela de busca
        $this->table  =  'enderecos';

        //Seta a condição de delete pelo ID do usuário
        $this->setWhere( "usu_id = '$this->idUsuario'" );

        //Seta a condição de delete pelo ID do usuário
        $this->setWhere( "end_id = '$this->idEndereco'" );

        //Deleta os dados
        $this->delete();

    }


    /**
    * Método verifica se o endereço não está associado a uma venda
    * @param  NULL
    * @return BOOL
    * @access PUBLIC
    */
    public function enderecoIsVenda() {

        //Reseta os attr de querys
        $this->reset();

        //Seta a tabela de busca
        $this->table  =  'vendas';

        //Seta os campos que desejo retornar
        $this->setField( 'ven_id' );

        //Seta a condição de busca pelo ID do usuário
        $this->setWhere( "end_id = '$this->idEndereco'" );

        //Seta a condição de busca pelo ID do usuário
        $this->setWhere( "usu_id = '$this->idUsuario'" );

        //Retorna os dados
        return $this->searchRecord();

    }


    /**
    * Método resgata o nome completo do usuário
    * @param  NULL
    * @return MIX STRING | BOOL
    * @access PUBLIC
    */
    public function getFullName() {

        //Reseta os attr de querys
        $this->reset();

        //Seta a tabela de busca
        $this->table  =  'usuarios';

        //Seta os campos que desejo retornar
        $this->setField( 'usu_nome, usu_sobrenome' );

        //Seta a condição de busca pelo ID do usuário
        $this->setWhere( "usu_id = '$this->idUsuario'" );

        //Realiza a consulta
        $data   =   $this->get();

        //Verifica se o retorno é igual a 1
        if( count( $data ) == 1 ) {

            //Monta o nome completo do usuário
            $nome   =   $data[0]->usu_nome . ' ' . $data[0]->usu_sobrenome;

            //Retorna o nome
            return $nome;

        }else {

            //Retorna false, pois ocorreu algum erro inesperado
            return false;

        }

    }


    /**
    * Método resgata o CPF
    * @param  NULL
    * @return MIX STRING | BOOL
    * @access PUBLIC
    */
    public function getCpf() {

        //Reseta os attr de querys
        $this->reset();

        //Seta a tabela de busca
        $this->table  =  'usuarios';

        //Seta os campos que desejo retornar
        $this->setField( 'usu_cpf' );

        //Seta a condição de busca pelo ID do usuário
        $this->setWhere( "usu_id = '$this->idUsuario'" );

        //Realiza a consulta
        $data   =   $this->getRecord();

        //Checa o retorno e retorna de acordo com a condição
        return is_bool( $data ) ? false : $data;

    }


    /**
    * Método resgata o E-mail
    * @param  NULL
    * @return MIX STRING | BOOL
    * @access PUBLIC
    */
    public function getEmail() {

        //Reseta os attr de querys
        $this->reset();

        //Seta a tabela de busca
        $this->table  =  'usuarios';

        //Seta os campos que desejo retornar
        $this->setField( 'usu_email' );

        //Seta a condição de busca pelo ID do usuário
        $this->setWhere( "usu_id = '$this->idUsuario'" );

        //Realiza a consulta
        $data   =   $this->getRecord();

        //Checa o retorno e retorna de acordo com a condição
        return is_bool( $data ) ? false : $data;

    }


    /**
    * Método resgata o ID do usuário
    * @param  NULL
    * @return VOID
    * @access PUBLIC
    */
    public function getIDUsuario() {

        $this->reset();

        $this->table  =  'usuarios';

        $this->setField( 'usu_id' );

        $this->setWhere( "usu_email = '$this->email'" );

        $this->setWhere( "usu_cpf = '$this->cpf'" );

        $this->idUsuario   =   $this->getRecord();

    }


    /**
    * Método verifica se um usuário existe
    * @param  NULL
    * @return BOOL
    * @access PUBLIC
    */
    public function usuarioExists() {

        $this->reset();

        $this->table  =  'usuarios';

        $this->setField( 'usu_id' );

        $this->setWhere( "usu_id = '$this->idUsuario'" );

        return $this->searchRecord();

    }


    /**
    * Método verifica se o usuário possui um endereço cadastrado
    * @param  NULL
    * @return BOOL
    * @access PUBLIC
    */
    public function enderecoExists( $numero = '', $complemento = '' ) {

        $this->reset();

        $this->table  =  'enderecos';

        $this->setField( 'usu_id' );

        $this->setWhere( "usu_id = '$this->idUsuario'" );

        is_numeric( $this->idEndereco ) ? $this->setWhere( "end_id = '$this->idEndereco'" ) : null;

        is_numeric( $this->cep ) ? $this->setWhere( "end_cep = '$this->cep'" ) : null;

        if( trim( $complemento ) != '' && trim( $numero ) != '' ) {
        
            $this->setWhere( "end_complemento = '$complemento'" );

            $this->setWhere( "end_numero = '$numero'" );

        }

        return $this->searchRecord();

    }

    /**
    * Método reseta os endereços principais do sistema
    * @param  NULL
    * @return BOOL
    * @access PUBLIC
    */
    public function resetAllEnderecoPrincipal() {

        $this->reset();

        $this->table  =  'enderecos';

        $this->setField( 'usu_id' );

        $gravar  =  array( 'end_principal' => 0 );

        $this->setWhere( "usu_id = '$this->idUsuario'" );        

        $this->update( $gravar );

    }

    /**
    * Método verifica se um determinado CEP existe na conta do usuário
    *
    * @param  NULL
    * @return BOOL
    * @access PUBLIC
    */
    public function cepExists() {

        $this->reset();

        $this->table  =  'enderecos';

        $this->setField( 'end_cep' );

        $this->setWhere( "usu_id = '$this->idUsuario'" );

        $this->setWhere( "end_cep = '$this->cep'" );

        return $this->searchRecord();

    }


    /**
    * Método obtem o CEP com base no ID do endereço
    * @param  NULL
    * @return BOOL
    * @access PUBLIC
    */
    public function getCepById() {

        $this->reset();

        $this->table  =  'enderecos';

        $this->setField( 'end_cep' );

        $this->setWhere( "usu_id = '$this->idUsuario'" );

        $this->setWhere( "end_id = '$this->idEndereco'" );

        $this->cep  =  $this->getRecord();

        return is_bool( $this->cep ) ? false : true;

    }


    /**
    * Método verifica se o CPF existe em banco de dados
    * @param  NULL
    * @return BOOL
    * @access PUBLIC
    */
    public function cpfExists() {

        $this->reset();

        $this->table  =  'usuarios';

        $this->setField( 'usu_id' );

        $this->setWhere( "usu_cpf = '$this->cpf'" );

        if( is_numeric( $this->idUsuario ) ) $this->setWhere( "usu_id != '$this->idUsuario'" );

        return $this->searchRecord();

    }


    /**
    * Método verifica se o email existe em banco de dados
    * @param  NULL
    * @return BOOL
    * @access PUBLIC
    */
    public function emailExists() {

        $this->reset();

        $this->table  =  'usuarios';

        $this->setField( 'usu_id' );

        $this->setWhere( "usu_email = '$this->email'" );

        if( is_numeric( $this->idUsuario ) ) $this->setWhere( "usu_id != '$this->idUsuario'" );

        return $this->searchRecord();

    }


    /**
    * Método resgata o ID do endereço
    * @param  NULL
    * @return MIX STRING | INT
    * @access PUBLIC
    */
    public function getIDEndereco() {

        $this->reset();

        $this->table  =  'enderecos';

        $this->setField( 'end_id' );

        $this->setWhere( "end_cep = '$this->cep'" );

        $this->setWhere( "usu_id = '$this->idUsuario'" );

        $id   =   $this->getRecord();

        if( is_numeric( $id ) ) {
            
            $this->idEndereco  =   $id;

            return true;

        }else {

            return false;

        }

    }


    /**
    * Método resgata o endereço completo do usuário com base no CEP
    * @param  NULL
    * @return ARRAY
    * @access PUBLIC
    */
    public function getFullEndereco() {

        $this->reset();
        
        $endereco   =   $this->getEndereco( $this->cep );

        $result     =   array();

        if( count( $endereco ) == 1 ) {

            $result['end']   =   $endereco[0]->log_nome;

            $result['bai']   =   $endereco[0]->bai_no;

            $result['est']   =   $endereco[0]->ufe_sg;

            $result['cid']   =   $endereco[0]->loc_no;

        }

        return $result;

    }


    /**
    * Método resgata todos os endereços do usuário
    * @param  NULL
    * @return ARRAY
    * @access PUBLIC
    */
    public function getAllEndereco() {

        $this->reset();

        $this->setField( 'end_id, end_cep, end_referencia, end_destinatario, end_principal, end_endereco, end_bairro, end_numero, end_complemento' );

        $this->setWhere( "usu_id = '$this->idUsuario'" );

        is_numeric( $this->idEndereco ) ? $this->setWhere( "end_id = '$this->idEndereco'" ) : null;

        $this->table  =   'enderecos';

        $data         =   $this->get();

        $result       =   array();

        if( count( $data ) > 0 ) {

            $prov = $i  = 0;

            foreach ( $data as $key ) {

                $this->cep          =   $key->end_cep;

                //$prov               =   $this->getFullEndereco();
                
                $result[$i]['val']  =   $key->end_id;

                $result[$i]['cep']  =   substr( $key->end_cep, 0, 5 ) . '-' . substr( $key->end_cep, 5 );

                $result[$i]['end']  =   $key->end_endereco;

                $result[$i]['bai']  =   $key->end_bairro;

                $result[$i]['num']  =   $key->end_numero;

                $result[$i]['com']  =   $key->end_complemento;

                $result[$i]['ptr']  =   $key->end_referencia;

                $result[$i]['des']  =   $key->end_destinatario;

                $result[$i]['pri']  =   $key->end_principal == 1 ? 'Sim' : 'Não';

                $result[$i]['cid']  =   $prov['cid'] ?: 'Sao Paulo';

                $result[$i]['est']  =   $prov['est'] ?: 'Sao Paulo';

                $i++;

            }

        }

        return $result;

    }


    /**
    * Método obtem todos os dados de cadastro do usuário
    * @param  NULL
    * @return ARRAY
    * @access PUBLIC
    */
    public function getAllDataUser() {

        //Reseta os atributos de Querys
        $this->reset();

        //Instancia a classe de datas
        $this->Dates  =   new extend\Dates();

        //Seta os campos que desejo retornar
        $this->setField( 'usu_nome, usu_sobrenome, usu_cpf, usu_sexo, usu_nascimento, usu_email' );

        //Seta a condição de busca
        $this->setWhere( "usu_id = '$this->idUsuario'" );

        //Seta a tabela de busca
        $this->table  =  'usuarios';

        //Realiza a consulta
        $data         =   $this->get();

        //Declara o array que vamos retornar os dados
        $result       =   array( 
            'nome'         =>  '', 
            'sobrenome'    =>  '', 
            'cpf'          =>  '', 
            'sexo'         =>  '', 
            'data'         =>  '', 
            'email'        =>  ''
        );

        //Verifica se o usuário foi encontrado
        if( count( $data ) != 0 ) {

            //Atribui os dados as respectivas variaveis
            $result['nome']       =   $data[0]->usu_nome;

            $result['sobrenome']  =   $data[0]->usu_sobrenome;

            $result['cpf']        =   $data[0]->usu_cpf;

            $result['sexo']       =   $data[0]->usu_sexo;

            $result['data']       =   $this->Dates->format( $data[0]->usu_nascimento, 'd/m/Y');

            $result['email']      =   $data[0]->usu_email;

        }

        //Retorna os dados
        return $result;

    }

}







