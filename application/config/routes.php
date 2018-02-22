<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['default_controller'] = "home";

$route['admin'] = "admin/home";

/** ADMIN **/	
$route['admin/banners/visualizar/imagens/(:num)'] =  'admin/banners/visualizar_imagens/$1';

$route['admin/banners/(.*)']                      =  'admin/banners/$1';

$route['admin/menus/(.*)']                        =   'admin/menus/$1';

$route['admin/produtos/(.*)']                     =   'admin/produtos/$1';

$route['admin/produtos/(.*)']                     =   'admin/produtos/$1';

$route['admin/configuracoes/gateways']            =   'admin/configuracoes/gateways';

$route['admin/login/(.*)']                        =   'admin/login/$1';

$route['admin/login']                             =   'admin/login/index';

/** AJAX ADMIN **/
$route['admin/ajax/login/(.*)']                   =  'ajax/login_admin/$1';

$route['admin/ajax/produtos/(.*)']                =  'ajax/produtos_admin/$1';

$route['admin/ajax/produtos/(.*)']                =  'ajax/produtos_admin/$1';

$route['admin/ajax/banners/(.*)']                 =  'ajax/banners_admin/$1';

$route['admin/ajax/categorias/(.*)']              =  'ajax/categorias_admin/$1';

$route['admin/ajax/menus/(.*)']                   =  'ajax/menus_admin/$1';

$route['admin/ajax/config/(.*)']                  =  'ajax/configuracoes_admin/$1';

$route['admin/ajax/vendas/(.*)']                  =  'ajax/vendas_admin/$1';

$route['ajax/carrinho/(.*)']                      =  'ajax/carrinho_site/$1';

/** AJAX SITE **/
$route['ajax/minha/conta/atualizar/usuario']  =   'ajax/usuarios/atualizarUsuario';

$route['ajax/minha/conta/novo/endereco']      =   'ajax/usuarios/salvarEndereco';

$route['ajax/minha/conta/atualizar/endereco'] =   'ajax/usuarios/salvarEdicaoEndereco';

$route['ajax/minha/conta/(.*)']               =   'ajax/usuarios/$1';

/** SITE **/
$route['home/(.*)']                           =   'home/$1';

$route['produtos/(:num)']                     =   'produtos/index/$1';

$route['compras/carrinho']                    =   'produtos/carrinho';

$route['compras/precheckout']                =   'checkout/preCheckout';

$route['compras/checkout']                   =   'checkout/checkout';

$route['compras/checkout/pagamentoboleto']   =   'checkout/pagamentoBoleto';

$route['compras/checkout/pagamentocartao']   =   'checkout/pagamentoCartao';

$route['compras/checkout/finalizar']         =   'checkout/finalizarCompra';

$route['compras/checkout/compra-finalizada'] =   'checkout/finalizado';

$route['compras/checkout/notificacao']       =   'checkout/notificacao';

$route['compras/session']                    =   'produtos/getSession';

$route['compras/carrinho/finalizar/compra']   =   'ajax/carrinho_site/finalizar_compra';

$route['minha/conta/cadastrar']               =   'minha_conta/cadastrar';

$route['minha/conta/compras/detalhes/(:num)'] =   'minha_conta/detalhes_compra/$1';

$route['minha/conta/(.*)']                    =   'minha_conta/$1';

$route['minha/conta']                         =   'minha_conta/inicio';

$route['login']                               =   'acesso/login';

$route['conta/logar']                         =   'acesso/logar';

$route['atualizacao/notificacao/pagseguro']   =   'ajax/carrinho_site/notificacao';

$route['buscar/(.*)']                         =   'menu/index';


/*
$route['cartao/cadastrar/fatura']        =   "cartao/cadastrar_fatura";

$route['cartao/gerenciar/faturas']       =   "cartao/gerenciar_faturas";

$route['conta/plano/cadastrar']          =   "plano_conta/cadastrar";

$route['conta/plano/visualizar']         =   "plano_conta/visualizar";

$route['ajax/conta/plano/cadastrar']     =   "ajax/plano_conta/cadastrar";

$route['ajax/conta/plano/salvarEdicao']  =   "ajax/plano_conta/salvarEdicao";

$route['ajax/conta/plano/getNomeApelidoGrupo']  =   "ajax/plano_conta/getNomeApelidoGrupo";
*/

/** ADMIN **/

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */