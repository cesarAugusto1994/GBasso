<!--
var gotBodyFocus=0; // used in gotBFocus() function.

function escBackSpace() // called on document.body keydown event
 {
    if(event.keyCode == 8)
       {
          if  (gotBodyFocus == 1 | document.activeElement.getAttribute("type") != "text") // to avoid the backspace event except the Textbox 
           {
             //event.keyCode = 0;
             event.returnValue=false
           }
           
       }    
 }

function gotBfocus() //called on document.body onfocus event
{
  gotBodyFocus = 1;
 }

function lostBfocus() // called on document.body onblur event
{
  gotBodyFocus = 0;
}
function limpa(nr){
    if (document.layers){
        document.layers[nr].value = "";
    }
    else if (document.all){
            document.all[nr].value = "";
    }
    else if (document.getElementById){
        document.getElementById(nr).value = "";
    }
}

function visi(nr)
{
    if (document.layers)
    {
        vista = (document.layers[nr].visibility == 'hide') ? 'show' : 'hide';
        document.layers[nr].visibility = vista;
    }
    else if (document.all)
    {
        vista = (document.all[nr].style.visibility == 'hidden') ? 'visible' : 'hidden';
        document.all[nr].style.visibility = vista;
    }
    else if (document.getElementById)
    {
        vista = (document.getElementById(nr).style.visibility == 'hidden') ? 'visible' : 'hidden';
        document.getElementById(nr).style.visibility = vista;

    }
}

function blocking(nr)
{
    if (document.layers)
    {
        current = (document.layers[nr].display == 'none') ? 'block' : 'none';
        document.layers[nr].display = current;
    }
    else if (document.all)
    {
        current = (document.all[nr].style.display == 'none') ? 'block' : 'none';
        document.all[nr].style.display = current;
    }
    else if (document.getElementById)
    {
        current = (document.getElementById(nr).style.display == 'none') ? 'block' : 'none';
        document.getElementById(nr).style.display = current;
    }
}


//------------------------------------- 
function valida_cadastro()
   {
    var form = document.contato;

    if(form.nome.value == "")
      {
      alert("O Campo [Nome] deve ser preenchido!");
      form.nome.focus();
      return false;
      }
   
    if(form.email.value == "")
      {
      alert("O Campo [E-mail] deve ser preenchido!");
      form.email.focus();
      return false;
      }

    if(form.email.value.indexOf('@', 0) == -1)
      {
      alert("O Campo [E-mail] deve ser preenchido corretamente!");
      form.email.focus();
      return false;
      }

    if(form.email.value.indexOf('.', 0) == -1)
      {
      alert("O Campo [E-mail] deve ser preenchido corretamente!");
      form.email.focus();
      return false;
      }
      
   }   
//------------------------------------- 



// -->