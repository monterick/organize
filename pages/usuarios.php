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
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Document</title>
</head>
<body>





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div >
                    <form class="AppForm">

                        <div style="color: red;min-height: 30px;" id="resposta"></div>

                 
                        <div class="AppInput">                    
                            <label>
                                <span>Nome</span>
                                <input type="text" name="nome" id="nome">
                            </label>
                        </div>
                        <div class="AppInput">
                            <label>
                                <span>Senha</span>
                                <input type="password" name="pass" id="pass">
                            </label>
                        </div>
                        <div class="AppInput">
                            <label>
                                <span>Confirm a senha</span>
                                <input type="password" name="pass2" id="pass2">
                            </label>
                        </div>
                       

                    </form>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button onclick="salvar()" type="button" class="AppButton">Cadastrar</button>
            </div>
            </div>
        </div>
        </div>

    <h3 style="margin: 10px;"><i class="fa fa-users"></i> Usuários</h3>
        <button style="margin: 10px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        + Cadastrar
        </button>
    <div class="container">
        <div class="row">
            <div class="col">
                <div id="user_resp">

                </div>
            </div>
        </div>
    </div>
    <script>
        function listar_usuarios(){
            var fd = new FormData()
            fd.append('acao', 'listar')
            var Ajax = new XMLHttpRequest()
            Ajax.open('POST','../api/usuarios.php',true)
            Ajax.onreadystatechange = function(){
                if(Ajax.readyState == 4){
                    if(Ajax.status = 200){
                        var resposta = Ajax.responseText
                        document.getElementById('user_resp').innerHTML = resposta
                    }else{
                        document.getElementById('user_resp').innerHTML = 'Erro ao listar usuários'
                    }
                }
            }
            Ajax.send(fd)           
        }
        (function init_list(){
            listar_usuarios()
        })()

        function salvar(){
            var nome = document.getElementById('nome').value
            var pass = document.getElementById('pass').value
            var pass2 = document.getElementById('pass2').value
            if(nome == ''){
             alert('Preencha o campo nome')
            }else if(pass == ''){
             alert('Preencha o campo Senha')
            }
            else if(pass2 == ''){
             alert('Preencha a confirmação da senha')
            }else if(pass !== pass2){
             alert('As senhas não conferem!')
            }else{
            var fd = new FormData()
            fd.append('acao','salvar')
            fd.append('nome',nome)
            fd.append('pass',pass)
            var Ajax = new XMLHttpRequest()
            Ajax.open('POST','../api/usuarios.php',true)
            Ajax.onreadystatechange = function(){
                if(Ajax.readyState == 4){
                    if(Ajax.status = 200){
                     resposta = Ajax.responseText
                     if(resposta == 1){
                        Swal.fire(
                        'Usuário Adicionado!',
                        '',
                        'success'
                        ).then((result) => { 
                            listar_usuarios()      
                            $('.modal').modal('hide');             
                            
                        })
                     }
                     
                    }else{
                        Swal.fire(
                        'Erro ao salvar Usuário!',
                        '',
                        'error'
                        )
                    }
                }
            }
            Ajax.send(fd)
            }
           
        }
    </script>
</body>
</html>