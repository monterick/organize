<?php
session_start();
if(!isset($_SESSION['session_log'])){
    echo "Seu login expirou";  
    exit();
}
if($_SESSION['session_log']!='S'){
  echo "Seu login expirou";  
  exit();
}
//print_r($_SESSION);

#Array ( [session_login] => 1000 [session_log] => S [perfil] => 1 [nome] => Ricardo )
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/font-awesome.min.css">
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/sweetalert2.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>   
    <script src="../lib/drag-n-drop.js"></script>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Quadros</title>
</head>
<body>
  <style>
    .alt_hover{
      margin-right: 20px;
    }
    .alt_hover:hover{
      cursor: pointer;
    }
  </style>
    
    <input type="hidden" name="login" id="login" value="<?=$_SESSION['session_login']?>">
    <div class="container-fluid">
        <div id="resposta_quadro">
    
        </div>
    </div>
    <script>
        function listagem(){
           var login = document.getElementById('login').value
           var fd = new FormData();
           fd.append('acao','listar')
           fd.append('login',login)
           var Ajax = new XMLHttpRequest();
           Ajax.open('POST','../api/quadros.php',true)
           Ajax.onreadystatechange = function(){
             if(Ajax.readyState == 4){
               if(Ajax.status == 200){
                 resposta = Ajax.responseText
                 document.getElementById('resposta_quadro').innerHTML = resposta
               }else{
                 document.getElementById('resposta_quadro').innerHTML = 'Ops.. Erro ao listar seus quadros'
               }
             }
           }
           Ajax.send(fd)
        }

        (function init_list(){ listagem() })()
       
      function salvar(){

        var titulo = document.getElementById('titulo_quadro').value
        var observacao = document.getElementById('descricao_quadro').value
        var login = document.getElementById('login').value

    
       
        if(titulo == '' || observacao == ''){
         alert('Preencha todos os campos!')
        }else{

         var fd = new FormData(); 
         fd.append('acao','new')  
         fd.append('login',login)
         fd.append('nome',titulo)
         fd.append('alteracao',alteracao)
         fd.append('descricao',observacao)
      
         var Ajax = new XMLHttpRequest();
         Ajax.open('POST','../api/quadros.php',true)
         Ajax.onreadystatechange = function(){
            if(Ajax.readyState == 4){
              if(Ajax.status == 200){
                resultado = Ajax.responseText
          
                if(resultado == '1'){
                    Swal.fire(
                    'Quadro Adicionado!',
                    '',
                    'success'
                    ).then((result) => { 
                        listagem()          
                        $('.modal').modal('hide');                       
                        
                    })
                }else{
                    Swal.fire(
                    'Operação não realizada!',
                    resultado,
                    'error'
                    )
                }
              }else{
                Swal.fire(
                    'Operação não realizada!',
                    '',
                    'error'
                    )
              }
            }
         }
         Ajax.send(fd)         
       }
      }
      function listar_quadro(id){ 
        var fd = new FormData()
        fd.append('acao','ver_quadro')
        fd.append('id',id) 
        var Ajax = new XMLHttpRequest();
         Ajax.open('POST','../api/quadros.php',true)
         Ajax.onreadystatechange = function(){
            if(Ajax.readyState == 4){
              if(Ajax.status == 200){
               var resposta = Ajax.responseText
               document.getElementById('resposta_quadro').innerHTML = resposta  
              }else{
                document.getElementById('resposta_quadro').innerHTML = 'Tente novamente mais tarde';
              } 
          }
        }
        Ajax.send(fd)       
       
      }
   
      function nova_lista(id_quadro,alterar = false){

        var titulo_lista = document.getElementById('titulo_lista').value
        var cor_lista = document.getElementById('cor_lista').value;
         
        

        
          var fd = new FormData();

          if(alterar == true){
          var id_lista = document.getElementById('id_lista_alt').value
           fd.append('id_lista',id_lista)

           titulo_lista = document.getElementById('titulo_lista_alt').value
           cor_lista = document.getElementById('cor_lista_alt').value;

          }

          if(titulo_lista == ''){
           alert('Escolha um nome para a lista!')
          }else{

          fd.append('acao','new_lista')
          fd.append('cor',cor_lista)
          fd.append('titulo',titulo_lista)
          fd.append('id_quadro',id_quadro)
          
          var Ajax = new XMLHttpRequest()
          Ajax.open('POST','../api/quadros.php',true)
          Ajax.onreadystatechange = function(){
            if(Ajax.readyState == 4){
                if(Ajax.status == 200){
                  resposta = Ajax.responseText
                  Swal.fire(
                    resposta,
                  '',
                  'success'
                ).then((ev)=>{
                  listar_quadro(id_quadro)
                  $('.modal').modal('hide');
                })
                  console.log(resposta)
                }else{
                  Swal.fire(
                  'Erro!',
                  'tente novamente mais tarde',
                  'error'
                )
                }
            }
          }
          Ajax.send(fd)
        }
      
      }



      function alterar_lista(id){

        var fd = new FormData();
        fd.append('acao','alterar_lista_list')
        fd.append('id',id)

        var Ajax = new XMLHttpRequest();
         Ajax.open('POST','../api/quadros.php',true)
         Ajax.onreadystatechange = function(){
            if(Ajax.readyState == 4){
              if(Ajax.status == 200){
                resposta = Ajax.responseText
                document.getElementById('form_lista_resp').innerHTML = resposta
              }else{
                document.getElementById('form_lista_resp').innerHTML = 'Tente novamente mais tarde'
              }
          }

        }
        Ajax.send(fd) 
      }
  
      function excluir_lista(id_quadro){
        var id_lista = document.getElementById('id_lista_alt').value
        //console.log(id_lista)
        if(confirm('Deseja Realmente exluir esta lista?')){
          var fd = new FormData();
          fd.append('acao','excluir_lista')
          fd.append('id',id_lista)

          var Ajax = new XMLHttpRequest();
          Ajax.open('POST','../api/quadros.php',true)
          Ajax.onreadystatechange = function(){
              if(Ajax.readyState == 4){
                if(Ajax.status == 200){
                   resposta = Ajax.responseText
                   alert(resposta)
                   listar_quadro(id_quadro)
                   $('.modal').modal('hide');
                }else{
                  alert('Erro, tente novamente mais tarde!')
                }
              }
            } 
            Ajax.send(fd)          
         }

      }
      function form_newcartao(div){

        var div_app = div
        document.getElementById(div_app).style.display = 'block'      
      }
      function voltar_cartao(div){
       
       document.getElementById(div).style.display = 'none'
       
      }
      function salvar_cartao(id_quadro,id_lista){
         var nome =  document.getElementById('name_newcartao'+id_lista).value
         var fd = new FormData()
         if(nome == ''){
          
         }else{
         fd.append('acao','salvar_cartao')
         fd.append('id_lista',id_lista)
         fd.append('nome',nome)
         var Ajax = new XMLHttpRequest()
         Ajax.open('POST','../api/quadros.php',true)
         Ajax.onreadystatechange = function(){
           if(Ajax.readyState == 4){
             if(Ajax.status == 200){
              var resposta = Ajax.responseText
              resposta = Ajax.responseText
                  Swal.fire(
                    resposta,
                  '',
                  'success'
                ).then((ev)=>{
                  listar_quadro(id_quadro)                 
                })
              l
             }else{
               alert('Erro tente novamente mais tarde')
             }
           }
         }
         Ajax.send(fd)
        }                       
      }

      function oculta_botao(div){
        var comentario = document.getElementById('comentario_atv').value
        if(comentario == ''){
         document.getElementById('salvar_comentario').style.display = 'none'
        }
      }
    
      function listar_comentarios(id){
        var fd = new FormData()
        document.getElementById('id_tarefa_b').value = id
        fd.append('acao','listar_comentarios')
        fd.append('id',id)
        var Ajax = new XMLHttpRequest()
        Ajax.open('POST','../api/quadros.php',true)
        Ajax.onreadystatechange = function(){
          if(Ajax.readyState == 4){
           if(Ajax.status == 200){
            resposta = Ajax.responseText 
            document.getElementById('resposta_comentarios').innerHTML = resposta;
           }else{
            document.getElementById('resposta_comentarios').innerHTML = 'Erro ao listar, tente novamente mais tarde';
           }
          }
        }
        Ajax.send(fd)
       
      }

      function salvar_comentario(){
        var id_tarefa = document.getElementById('cod_tarefa').value
        var comentario = document.getElementById('comentario_atv').value
        var fd = new FormData()
        fd.append('acao','salvar_comentario')
        fd.append('comentario',comentario)
        fd.append('id_tarefa',id_tarefa)
        var Ajax = new XMLHttpRequest()
        Ajax.open('POST','../api/quadros.php',true)
        Ajax.onreadystatechange = function(){
          if(Ajax.readyState == 4){
             if(Ajax.status == 200){
               var resposta = Ajax.responseText
               console.log(resposta)
               listar_comentarios(id_tarefa)
             }
          }
        }
        Ajax.send(fd)
      }
                           
    </script>
   
</body>
</html>