<?php

session_start();

#####Inclusão da conexao pdo
include '../config/conexao.php';

$login = strip_tags(trim($_POST["login"]));
$senha = strip_tags(trim($_POST["pass"]));


if (trim($login == "")) {
    echo "O campo 'Login' deve ser preechido!";
} else if (trim($senha == "")) {
    echo "O campo 'Senha' deve ser preechido!";
} else {
    ########User e pass preenchidos
  
    try{
    if(!$pdo){
       throw new \Exception('Erro na conexão!');
    }    
    $sql_sel = "SELECT * FROM usuario WHERE login = ? AND password = MD5(?) and ativo ='1'";
    
    
    $stm = $pdo->prepare($sql_sel);
    $stm->execute(array($login, $senha));
    $numrows = $stm->rowCount();

    if ($numrows > 0) {
        if(isset($_SESSION['session_login'])){
        if ($_SESSION['session_login'] != $_POST["login"] and $_SESSION['session_login'] != '') {
            echo '
				<div class="alert alert-success" role="alert" >
				  	Você está conectado no login ' . $_SESSION['session_login'] . '. Deseja sair? <br>
				  	<a style="margin: 8px 0 15px 0; background: #3c763d; border-radius: 3px; padding: 5px 10px; color: #dff0d8; text-decoration: none;" href="logout_VL.php" id="gerencial"><i class="fa fa-sign-out"></i> Sim</a>
				</div>
				';
            exit();
        }
      } 
      ###Continue
     
      $rst_sel = $stm->fetch();

   
      $teste = $rst_sel['nome'];
     
      setcookie("user_credito", "$teste");

      //$_SESSION['nome_usuario'] = ;
      $_SESSION['session_login'] = $rst_sel['login'];

  
      ######################################################enviroment


      $_SESSION['session_log'] = 'S';  
      $_SESSION['perfil']  = $rst_sel['admin'];
      $_SESSION['nome'] = $rst_sel['nome'];
      

          echo "logar";
          exit();
    }else{
          echo "O Login ou Senha Inv&aacute;lido!";
    }
  }catch(\Exception $ex){
    echo $ex->getMessage();
  }
}  

