<?php
include '../config/conexao.php';
session_start();

if(!isset($_SESSION['session_log'])){
    echo "Seu login expirou";  
    exit();
}
if($_SESSION['session_log']!='S'){
  echo "Seu login expirou";  
  exit();
}

$acao = $_POST['acao'];

if($acao == 'listar'){ 
    //neste caso master é um administrador
    //master admin = 1
    $sel_all =  "SELECT * FROM usuario";
    $exec = $pdo->prepare($sel_all);
    $exec->execute();

    ?>
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Login</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Perfil</th>
                                <th scope="col">ação</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                              if($exec->rowCount() > 0){
                                while($rst = $exec->fetch(\PDO::FETCH_ASSOC)){?>
                                    <tr>
                                        <td><?=$rst['id']?></td>
                                        <td><?=$rst['login']?></td>
                                        <td><?=$rst['nome']?></td>
                                        <td><?php echo $nome = $rst['admin'] == 1 ? 'Master' : 'Usuario'; ?></td>
                                        <td><?php if($rst['admin']!=1){?><button onclick="excluir('<?=$rst['id']?>')" style="font-size: 12px;" class="btn btn-dark"><i class="fa fa-trash"></i><?php }?></button></td>
                                    </tr>    
                                <?php }
                              }
                            ?>
                            
                        </tbody>
                    </table>
<?php }

if($acao == 'salvar'){
  $nome = $_POST['nome'];
  $password = $_POST['pass'];
  $encript = md5($password);

  $sel_last = "SELECT login FROM usuario ORDER BY id DESC LIMIT 0,1";
  $exec_last = $pdo->prepare($sel_last);
  $exec_last->execute();
  $new_log = $exec_last->fetchColumn()+1;

  $insert = "INSERT INTO  usuario(nome,`password`,`login`) VALUES('{$nome}','{$encript}','{$new_log}')";
  $exec = $pdo->prepare($insert);
  $exec->execute();
  if($exec->rowCount() > 0){
      echo '1';
  }
}

if($acao == 'excluir'){

    $id = $_POST['id'];
    $del = "DELETE FROM usuario WHERE id = '{$id}'";
    $exec = $pdo->prepare($del);
    $exec->execute();
    if($exec->rowCount() > 0){
         echo '1';
    }

}