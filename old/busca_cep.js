/*
 *	Desenvolvido e criado por 
 *	Felipe Olivaes (felipe.olivaes AT terra.com.br)
 *	--------------------------------------------------
 *	2005-07-22 03:26
 */
  

var sVersao	= navigator.appVersion;
var bIsIE = ( (sVersao.indexOf("IE") > -1) || (sVersao.indexOf("Mac") > -1) ) ;

function get(elemento){
	if ( bIsIE ){
		return document.all[elemento];
	} else {	
		return document.getElementById(elemento);
	}
}

function LTrim(str){
	var whitespace = new String(" \t\n\r");
	var s = new String(str);

	if (whitespace.indexOf(s.charAt(0)) != -1) {
      var j=0, i = s.length;
      while (j < i && whitespace.indexOf(s.charAt(j)) != -1)
         j++;
      s = s.substring(j, i);
   }
   return s;
}

function RTrim(str){
   var whitespace = new String(" \t\n\r");

   var s = new String(str);

   if (whitespace.indexOf(s.charAt(s.length-1)) != -1) {
      var i = s.length - 1;      
      while (i >= 0 && whitespace.indexOf(s.charAt(i)) != -1)
         i--;
      s = s.substring(0, i+1);
   }
   return s;
}

function trim(str){
   return RTrim(LTrim(str));
}

function soh_numero(numero){
	var validos = "0123456789";
	var numero_ok = '';
	for(i=0;i<numero.length;i++){
		if(validos.indexOf(numero.substr(i,1)) != -1){
			numero_ok += numero.substr(i,1); 
		}
	}
	return numero_ok;
}

function verifica_cep(cep_value){
	var cep_limpo = trim(soh_numero(cep_value));
	get('cep').value = cep_limpo;
	get('buscar_cep').src = '/busca_cep.php?cep='+cep_limpo;
}

function from_cep(cep_tp_log,cep_logradouro,cep_bairro,cep_cidade,cep_uf,resultado){
	//get('tp_log').value 	= cep_tp_log;
	get('logradouro').value = cep_logradouro;
	get('bairro').value 	= cep_bairro;
	get('cidade').value 	= cep_cidade;
	get('uf').value 		= cep_uf;

	if(resultado == 1){
		//Busca Completa
		get('numero').focus();			
	} else {
		get('tp_log').focus();
	}
}