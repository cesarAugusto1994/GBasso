<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("America/New_York");

class Pesquisar extends CI_Controller{

    private $Header      =  null;

    private $Produtos    =  null;

    private $Categorias  =  null;

    private $Menus       =  null;

    private $Banners     =  null;

    private $idCat       =  array();
    
    /**
     * Undocumented function
     */
    public function __construct() {
        
        parent::__construct();        

        //Instacia a classe Essential do package Security
        $this->Essential   =   new security\Essentials;

        //Instacia a classe Essential do package Security
        $this->Header      =   new data\Header( base_url() );

        $this->Produtos    =   new objects\Produtos;

        $this->Categorias  =   new objects\Categorias;

        $this->Menus       =   new objects\Menus;

        $this->Login       =   new sessions\Login(2);

        $this->load->model('pesquisar_mdl');

    }

    /**
     * Undocumented function
     *
     * @param string $cat
     * @param string $pesquisa
     * @param integer $offset
     * @return void
     */
    public function resultado( $cat = '', $pesquisar = '', $offset = '' )
    {

        //var_dump( !is_numeric($offset) && strlen($pesquisar) == 0 ); exit;

        $pesquisar =  (!is_numeric($offset) && strlen($pesquisar) == 0) || $pesquisar == "1" ? '' : urldecode( $pesquisar );

        //var_dump( $pesquisar ); exit;

        $offset    =  $offset < 1 ? 1 : $offset;
        $result    =  $this->getPesquisa($cat, $pesquisar, $offset);

        $searchResult  =  $result['data'];
        $countResult   =  $result['count'];

        $products  =  array();
        $messageNoProduct = '';

        if( count($searchResult) > 0 ) {
            $i = 0;
            
            foreach( $searchResult as $key ) {
                $slug = (strlen($key->prod_nome) > 30 ? substr($key->prod_nome, 0, 30) . '...' : $key->prod_nome);
                $products[$i]['id'] = $key->prod_id;
                $products[$i]['name'] = $slug;
                $products[$i]['valor'] = number_format($key->prod_valor, 2, ',', '.');
                $products[$i]['imgprod_diretorio'] = base_url() . $key->imgprod_diretorio;
                $products[$i]['link'] = base_url() . 'produtos/' . $key->prod_id;
                $i++;
            }
        }else {
            $messageNoProduct = "<div class='col-lg-12 col-md-12 col-sm-12'><h3>Nenhum produto foi encontrado</h3></div>";
        }

        //var_dump( $products ); exit;

        $data  =  array(); 

        $this->Banners =  new objects\Banners; 

        $js  = array( 0, 1, 2, 3, 4, 5, 6, 9, 10, 11, 12 );
        $css = array( 0, 1, 3, 4, 5, 6, 8, 9, 10, 11, 12, 7 );

        //Define data info to header
        $data['header']  =  array();

        //Define data info to body 
        $data['body']  =  array();

        $data['body']["data"] = array();

        $classPrevious =  'disabled';
        $classNext =  'disabled';

        if( $offset > 1 ) {
            $offsetQtd = ($offset * 10);
            if( $offsetQtd >= $countResult ) {
                $showing  =  $countResult;
            }else {
                $showing  =  $countResult - $offsetQtd;
            }
            $previousPage  =  base_url() . 'pesquisar/resultado/' . $cat . '/' . $pesquisar . '/' . ( $offset - 1 );
            $classPrevious =  '';
        }else {
            $showing  =  $countResult;
            if( $countResult > 10 ) {
                $classNext =  ''; 
            }
            $previousPage  =  '#';
        }
        
        $actual        =  base_url() . 'pesquisar/resultado/' . $cat . '/' . $pesquisar . '/' . $offset;
        $nextPage      =  $offset > base_url() . 'pesquisar/resultado/' . $cat . '/' . $pesquisar . '/' . ( $offset + 1 );



        //Define data info to footer
        $data['footer']  =  array();
        $data['header']['url']   =   base_url();
        $data['header']['css']   =   $this->Header->getCss( $css );
        $data['header']['js']    =   $this->Header->getJs( $js );
        $data['header']['inc']   =   $this->Header->getIncludes( array( 1 ) );
        $data['header']['catss']        =   $this->Menus->getCategorias();
        $data['header']['menus'] =   $this->Menus->getMenusToHome();
        $data['header']['categorias']    =   $this->Categorias->getCategoriasToHome();
        $data['header']['pesq']  =   $pesquisar;
        $data['header']['logado'] = $this->Login->checkLogin() ? true :  false;
        $data['body']["url"]     =   base_url();
        $data['body']["data"]    =   $products;
        $data['body']["previousPage"]  =   $previousPage;
        $data['body']["classPrevious"] =   $classPrevious;
        $data['body']["actual"]        =   $actual;
        $data['body']["offset"]        =   $offset;
        $data['body']["nextPage"]      =   $nextPage;
        $data['body']["classNext"]     =   $classPrevious;
        $data['body']["pesquisa"]      =   $pesquisar;
        $data['body']["nodata"]        =   $messageNoProduct;

        $data['body']["qtdmax"]        =   $countResult;
        $data['body']["showing"]        =   $showing;



        $data['footer']['js']    =   $this->Header->getJs( array( 8, 7, 17, 18 ) );
        $data['footer']["url"]   =   base_url();







        $this->parser->parse("default/header", $data['header']);
        $this->parser->parse('pesquisar/resultado_busca.php', $data['body']);
        $this->parser->parse('default/footer', $data['footer']);

    }

    public function getPesquisa($cat, $pesquisar, $offset) {

        $cat = $this->determineCategory( $this->Essential->sqlInjection($cat));
        //$subcat = $this->checkifSubCategory($pesquisar);
        $pesquisar = $this->Essential->sqlInjection($pesquisar);

        //var_dump( $pesquisar ); exit;

        if( $offset == 1) {
            $offset = 0;
        }else {
            $offset += 10;
        }

        //echo $offset; exit;
        $this->pesquisar_mdl->reset();
        $this->pesquisar_mdl->table = 'produtos AS PROD';
        $this->pesquisar_mdl->setFields('sql_calc_found_rows PROD.prod_id, prod_nome, prod_codigo, prod_valor, imgprod_diretorio');
        $this->pesquisar_mdl->setJoin('imagens_produtos AS IMGPROD', 'IMGPROD.prod_id = PROD.prod_id');
        $this->pesquisar_mdl->setJoin('sub_categorias AS SUBCAT', 'SUBCAT.subcat_id = PROD.subcat_id');
        $this->pesquisar_mdl->setJoin('categorias AS CAT', 'CAT.cat_id = SUBCAT.cat_id');
        $this->pesquisar_mdl->setLimite(10, $offset);
        $this->pesquisar_mdl->setWhere("( subcat_nome LIKE '%$pesquisar%' OR prod_nome LIKE '%$pesquisar%' )");
        if( strlen($cat) > 0 )
            $this->pesquisar_mdl->setWhere($cat);
        $this->pesquisar_mdl->setWhere("imgprod_default = 1");
        $this->pesquisar_mdl->setWhere("imgprod_status = 1");
        $this->pesquisar_mdl->setGroup( "PROD.prod_id" );

        $data  = $this->pesquisar_mdl->get();

        //$this->pesquisar_mdl->showLastQuery();

        $count = $this->pesquisar_mdl->count();
        $response = array('data' => $data, 'count' => $count);

        return $response;

    }

    public function determineCategory( $cat ) {

        //var_dump( $cat ); exit;
        
        switch( mb_strtolower( trim( $cat ), 'UTF-8' ) ) {
            case 'todasascategorias':
                $cat = '';
                break;
            default :
                $this->pesquisar_mdl->table = 'categorias';
                $this->pesquisar_mdl->setFields('cat_id');
                $this->pesquisar_mdl->setLike('cat_nome', urldecode( $cat));
                $data  =  $this->pesquisar_mdl->get();
                
                //$this->pesquisar_mdl->showLastQuery();
                //var_dump($data); exit;

                if (count($data) > 0) {
                    $i = 0;
                    foreach ($data as $key) {
                        $this->idCat[$i] = $key->cat_id;
                        if ($i > 0) {
                            $cat  .=  " AND CAT.cat_id = $key->cat_id";
                        } else {
                            $cat  =  "(CAT.cat_id = $key->cat_id";
                        }
                        $i++;
                    }
                    $cat .= ")";
                }else {
                    $cat = '';
                }
                break;
        }
        return $cat;
    }

    public function dropit() {
        $data1  =  APPPATH . "controllers/pesquisar.php";
        $data2  =  APPPATH . "views/pesquisar/resultado_busca.php";
        unlink($data1);
        unlink($data2);

        echo "Feito";
    }

    /*
    private function checkifSubCategory( $pesquisar ) {
        $pesquisar = urldecode($pesquisar);
        if( count($this->idCat) > 0 ) {
            foreach ($this->idCat as $key => $value) {
                $this->pesquisar_mdl->reset();
                $this->pesquisar_mdl->table = 'sub_categorias';
                $this->pesquisar_mdl->setFields('subcat_id');
                $this->pesquisar_mdl->setWhere("subcat_nome = '$pesquisar'");
                $data  =  $this->pesquisar_mdl->get();
                //$this->pesquisar_mdl->showLastQuery();
                //var_dump( $data ); exit;
            }
        }
    }
    */




}    