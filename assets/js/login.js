function valida_login(){
var user = document.getElementById('login').value
var pass = document.getElementById('pass').value

     var Ajax = new XMLHttpRequest();
     var fd = new FormData();
     fd.append('login',user)
     fd.append('pass',pass)
     Ajax.open('POST','./api/valida_login.php',true)
     Ajax.onreadystatechange = function(){
        if(Ajax.readyState == 4) { // Quando estiver tudo pronto.
            if(Ajax.status == 200) {
                var resultado = Ajax.responseText; // Coloca o retornado pelo Ajax nessa vari�vel
                    
                     if(resultado == 'logar'){
                        document.getElementById('resposta').style.display = "none";        
                        location.href = "./pages/home.php";                          
                     }else{
                        document.getElementById('resposta').innerHTML = resultado;
                     }
                     
                } else {
                    exibeResultado.innerHTML = "Por favor, tente novamente!";
                }
                }
        }
        Ajax.send(fd)
     }




