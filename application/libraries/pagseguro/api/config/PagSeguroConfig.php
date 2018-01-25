<?php

/*
 ************************************************************************
 PagSeguro Config File
 ************************************************************************
 */

$PagSeguroConfig = array();

$PagSeguroConfig['environment'] = "sandbox"; // production, sandbox

$PagSeguroConfig['credentials'] = array();

//$PagSeguroConfig['credentials']['email'] = "clinco@webmkt.com.br"; 
$PagSeguroConfig['credentials']['token']['production'] = "";
//$PagSeguroConfig['credentials']['token']['sandbox'] = "3DE59198A46349CF88C9E495FFC05932";

$PagSeguroConfig['credentials']['email'] = "cezzaar@gmail.com"; 
$PagSeguroConfig['credentials']['token']['sandbox'] = "F103EDB34EC44003885F413C377F3F42";

$PagSeguroConfig['application'] = array();
$PagSeguroConfig['application']['charset'] = "UTF-8"; // UTF-8, ISO-8859-1

$PagSeguroConfig['log'] = array();
$PagSeguroConfig['log']['active'] = FALSE;
$PagSeguroConfig['log']['fileLocation'] = "../logs/log_pagseguro.txt";
