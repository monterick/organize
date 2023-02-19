<?php
include '../config/conexao.php';
$acao = $_POST['acao'];

switch($acao){
  case 'listar':

    $login = $_POST['login'];

    $sel = "SELECT * FROM quadros WHERE login = ?";

    $stm = $pdo->prepare($sel);
    $stm->bindParam(1, $login, \PDO::PARAM_INT);
    $stm->execute();

?>


    <!-- Modal -->
    <div><i class="fa fa-user"></i> Seus Quadros</div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Quadro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form >                

                    <div style="color: red;min-height: 30px;" id="resposta"></div>

                    <div class="AppInput">                    
                        <label>
                            <span>Título</span>
                            <input type="text" name="titulo_quadro" id="titulo_quadro">
                        </label>
                    </div>
                    <div class="AppInput">
                        <label>
                            <span>Observações</span>
                            <input type="text" name="descricao_quadro" id="descricao_quadro">                            
                        </label>
                    </div>
                    
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" onclick="salvar()" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="row">
        <?php if ($stm->rowCount() > 0) {

            while ($rst = $stm->fetch(\PDO::FETCH_ASSOC)) {
        ?>
                <div class="col-md-3" style="margin: 5px;">

                    <div onclick="listar_quadro('<?=$rst['id']?>')" class="btn btn-light card" style="width: 18rem;">
                        <h4 src="..." class="card-img-top"><?=$rst['nome']?></h4>
                        <div class="card-body">
                            <p class="card-text"><?=$rst['descricao']?></p>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
        <div class="col-md-3">
            <div class="btn btn-light card" style="width: 18rem" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <div class="card-body">
                    <h5 class="card-title">+ Novo Quadro</h5>
                </div>
            </div>
        </div>
    </div>
  
<?php   
 break;
 case 'new':
   

    $login = $_POST['login'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    
    $insert = "INSERT INTO quadros(`login`,nome,descricao,`data_cadastro`) VALUES ('{$login}','{$nome}','{$descricao}',DATE_FORMAT( NOW() , '%Y-%m-%d'))";
  
    $exec = $pdo->prepare($insert);
    $exec->execute();

    if($exec->rowCount() > 0){
      echo '1';
    }else{
      echo 'Não foi possível realizar a alteração! Tente novamente mais tarde';  
    }


 break;
 case 'ver_quadro': 

    $id = $_POST['id'];
    $sel = "SELECT * from quadros WHERE id = '{$id}'";
    $stm = $pdo->prepare($sel);
    $stm->execute();
    $rst = $stm->fetchAll(\PDO::FETCH_ASSOC);
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Minhas listas</title>    
        <link rel="stylesheet" href="../lib/style.css">

        
    </head>
    <body>
        
 

        <!-- Modal -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">+Nova Tarefa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                <div class="AppInput">                    
                        <label>
                            <span>Título</span>
                            <input type="text" name="titulo_lista" id="titulo_lista">
                        </label>
                    </div>
                    <div class="AppInput">
                        <label>
                            <span>Cor</span>
                            <input style="max-width: 100px;" class="form-control" type="color" id="cor_lista" name="cor_lista" list="arcoIris" value="#FF0000">
                            <datalist id="arcoIris">
                            <option value="#FF0000">Vermelho</option>
                            <option value="#FFA500">Laranja</option>
                            <option value="#FFFF00">Amarelo</option>
                            <option value="#008000">Verde</option>
                            <option value="#0000FF">Azul</option>
                            <option value="#4B0082">Indigo</option>
                            <option value="#EE82EE">Violeta</option>
                            </datalist>                           
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="nova_lista('<?=$id?>')">Salvar</button>
            </div>
            </div>
        </div>
        </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">+Nova Lista</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                <div class="AppInput">                    
                        <label>
                            <span>Título</span>
                            <input type="text" name="titulo_lista" id="titulo_lista">
                        </label>
                    </div>
                    <div class="AppInput">
                        <label>
                            <span>Cor</span>
                            <input style="max-width: 100px;" class="form-control" type="color" id="cor_lista" name="cor_lista" list="arcoIris" value="#FF0000">
                            <datalist id="arcoIris">
                            <option value="#FF0000">Vermelho</option>
                            <option value="#FFA500">Laranja</option>
                            <option value="#FFFF00">Amarelo</option>
                            <option value="#008000">Verde</option>
                            <option value="#0000FF">Azul</option>
                            <option value="#4B0082">Indigo</option>
                            <option value="#EE82EE">Violeta</option>
                            </datalist>                           
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="nova_lista('<?=$id?>')">Salvar</button>
            </div>
            </div>
        </div>
        </div>

        <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Alterar Lista</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="form_lista_resp">
                
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="excluir_lista('<?=$id?>')">Excluir</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="nova_lista('<?=$id?>',true)">Salvar</button>
            </div>
            </div>
        </div>
        </div>

            <!-- Modal -->
        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detalhe Atividades</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="resposta_atividade">
                    <div class="row">
                        <div class="col">
                        <i class="fa fa-list"></i> Atividades
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col">
                            <input type="hidden" name="cod_tarefa" id="cod_tarefa">
                            <textarea placeholder="Escrever um comentário" onfocus="document.getElementById('salvar_comentario').style.display = 'block'" onfocusout="oculta_botao('salvar_comentario')" class="form-control" name="comentario_atv" id="comentario_atv" cols="30" rows="1"></textarea>
                            <button id="salvar_comentario" onclick="salvar_comentario()" style="margin-top: 10px;display: none;" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div id="resposta_comentarios">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
            </div>
        </div>
        </div>


     

        <h5><?=$rst[0]['nome']?></h5>
         <div class="row">
            <?php
              $sel_listas = "SELECT * FROM listas WHERE quadro_fk = '{$rst[0]['id']}'";
              $exc = $pdo->prepare($sel_listas);
              $exc->execute();
              if($exc->rowCount()){
                while($rst1 = $exc->fetch(\PDO::FETCH_ASSOC)){ $id_lista = $rst1['id']; ?>
                       <div class="col-md-3">
                       <div id="<?=$rst1['id']?>"  style="margin: 10px;"  class="column column-todo" ondrop="drop(event)" ondragover="allowDrop(event)">
                            <h2  style="color: #fff; background-color: <?=$rst1['cor']?>;"> <i data-bs-toggle="modal" data-bs-target="#exampleModal4" onclick="alterar_lista('<?=$rst1['id']?>')" class="alt_hover fa fa-pencil" style="background-color: <?=$rst1['cor']?>;"></i><?=$rst1['nome']?></h2>                                                       
                            <?php 
                            $sel_card = "SELECT * FROM cartao where lista_fk = '{$rst1['id']}'";
                            $exec_card = $pdo->prepare($sel_card);
                            $exec_card->execute();
                             if($exec_card->rowCount()>0){ 
                                while($rst2 = $exec_card->fetch(\PDO::FETCH_ASSOC)){
                            ?>
                            <article onclick="listar_comentarios('<?=$rst2['id']?>')" data-bs-toggle="modal" data-bs-target="#exampleModal3" class="card" draggable="true" ondragstart="drag(event)" data-id="<?=$rst2['id']?>">
                                <h6><?=$rst2['nome']?></h6>
                            </article>  
                            <?php 
                            } ?>
                            
                            <?php
                        }?>  
                                     
                        </div>
                        <div id="form_cartao<?=$id_lista?>"  style="margin: 10px;margin-top: -10px;" class="column column-todo"><button onclick="form_newcartao('div_cartao<?=$id_lista?>')" style="font-size: 10px;" class="btn btn-secondary"><i class="fa fa-pencil"></i>+Tarefa</button>
                          <div id="div_cartao<?=$id_lista?>" style="margin-top: 5px; display: none;">
                                <input type="text" id="name_newcartao<?=$id_lista?>" name="name_newcartao" class="form-control">
                                <button style="margin-top:5px" onclick="salvar_cartao('<?=$id?>','<?=$id_lista?>')" class="btn btn-primary">Salvar</button>
                                <button style="margin-top:5px;margin-left:5px" onclick="voltar_cartao('div_cartao<?=$id_lista?>')" class="btn btn-secondary">Cancelar</button>
                            
                          </div>
                        </div>
                        </div>

                <?php }
              }
            ?>
            <div class="col-md-2">
            <div style="margin: 10px;" data-bs-toggle="modal" data-bs-target="#exampleModal2"  class="btn btn-secondary column column-todo" >
                <h3 style="color: black;">+ Nova Lista</h3>                   
            </div>
         </div>
         </div>
    </body>
</html>
 <?php
 break;
 case 'alterar_cartao_pos' :

    $id_lista = $_POST['id_lista'];
    $id_cartao = $_POST['id_cartao'];
    
    $update = "UPDATE cartao SET lista_fk = '{$id_lista}' WHERE id = '{$id_cartao}'";
    $up = $pdo->prepare($update);
    $up->execute();
    if($up->rowCount() > 0){
      echo "Alteração realizada!";
    }

 break ;   
 case 'new_lista':

  if(isset($_POST['id_lista'])){
   $id_lista = $_POST['id_lista'];
   $alteracao = true;
  }  

  $cor = $_POST['cor'];
  $titulo = $_POST['titulo'];
  $id_quadro = $_POST['id_quadro'];

  if(isset($alteracao)){

    $insert = "UPDATE `organize`.`listas` SET `nome` = '{$titulo}', `cor` = '{$cor}' WHERE `id` = '{$id_lista}'"; 
    $msg = "Cartão alterado com sucesso!";
  }else{
   
        $insert = "INSERT INTO `organize`.`listas` (`nome`, `cor`, `data_cadastro`, `quadro_fk`) 
        VALUES ('{$titulo}', '{$cor}', NOW(), '{$id_quadro}')";
        $msg = "Novo cartão inserido com sucesso!";
  }       



  $ex_insert = $pdo->prepare($insert);
  $ex_insert->execute();
  
  if($ex_insert->rowCount()>0){
   echo $msg;
  }

 break;   
 
 case 'alterar_lista_list';

 $id = $_POST['id'];
 $sel = "SELECT * FROM listas WHERE id = '{$id}'";
 $exec = $pdo->prepare($sel);
 $exec->execute();
 while($rst = $exec->fetch(\PDO::FETCH_ASSOC)){

    $titulo = $rst['nome'];
    $cor = $rst['cor'];

 ?>
 
         <!-- Modal -->

                <form>
                <div class="AppInput">                    
                        <label>
                            <span>Título</span>
                            <input type="hidden" name="id_lista_alt" id="id_lista_alt" value="<?=$id?>">
                            <input type="text" name="titulo_lista_alt" id="titulo_lista_alt" value="<?=$titulo?>">
                        </label>
                    </div>
                    <div class="AppInput">
                        <label>
                            <span>Cor</span>
                            <input style="max-width: 100px;" class="form-control" type="color" id="cor_lista_alt" name="cor_lista_alt" list="arcoIris" value="<?=$cor?>">
                            <datalist id="arcoIris">
                            <option  <?php if($cor =='#FF0000'){?> selected <?php }?> value="#FF0000">Vermelho</option>
                            <option  <?php if($cor =='#FFA500'){?> selected <?php }?> value="#FFA500">Laranja</option>
                            <option  <?php if($cor =='#FFFF00'){?> selected <?php }?> value="#FFFF00">Amarelo</option>
                            <option  <?php if($cor =='#008000'){?> selected <?php }?> value="#008000">Verde</option>
                            <option  <?php if($cor =='#0000FF'){?> selected <?php }?> value="#0000FF">Azul</option>
                            <option  <?php if($cor =='#4B0082'){?> selected <?php }?> value="#4B0082">Indigo</option>
                            <option  <?php if($cor =='#EE82EE'){?> selected <?php }?> value="#EE82EE">Violeta</option>
                            </datalist>                           
                        </label>
                    </div>
                </form>
          
 
 <?php }

 break;

 case 'excluir_lista':   
    $id = $_POST['id'];
    $delete = "DELETE FROM listas WHERE id = '{$id}'";
    $exec = $pdo->prepare($delete);
    $exec->execute();
    if($exec->rowCount() > 0){
        echo "Lista excluída Com sucesso!";
    }else{
        echo "Nenhum registro foi excluído!";
    }
    
 break;  
 
 case 'salvar_cartao':

 $id_lista = $_POST['id_lista'];  
 $nome = $_POST['nome'];

 $insert = "INSERT INTO cartao(nome,lista_fk,data_cadastro) VALUES('{$nome}','{$id_lista}',NOW())";
 $exec = $pdo->prepare($insert);
 $exec->execute();
 if($exec->rowCount()>0){
   echo 'Cartão gravado com sucesso!';
 }

 break;   

 case 'listar_comentarios':
    $id_tarefa = $_POST['id'];
    //comentarios de Tarefas
    $select =  "SELECT * FROM atividade WHERE tarefa_id = '{$id_tarefa}' order by id desc";
    $exec = $pdo->prepare($select);
    $exec->execute();
    if($exec->rowCount() > 0){ echo "Histórico";
      while($rst = $exec->fetch(\PDO::FETCH_ASSOC)){ 
        
        ?>
          <div class="row" style="margin-top: 5px;">                        
                <div class="col">
                    <input type="hidden" name="cod_tarefa_alt<?=$id_tarefa?>" id="cod_tarefa_alt<?=$id_tarefa?>" value="<?=$id_tarefa?>">
                    <textarea  disabled class="form-control" name="comentario_atv_alt<?=$rst['id']?>" id="comentario_atv_alt<?=$rst['id']?>"  cols="30" rows="1" ><?=$rst['descricao']?></textarea>
                    <div><a href="#">Excluir</a><a href="#" style="margin-left: 10px;">Editar</a></div>                    
                    <button id="salvar_comentario_alt<?=$rst['id']?>" onclick="('opaa')" style="margin-top: 10px;display: none;" class="btn btn-primary">Salvar</button>
                </div>
            </div>
      <?php }
    }
 break;   

 case 'salvar_comentario';
  $comentario = $_POST['comentario'];
  $id_tarefa = $_POST['id_tarefa'];

  $insert = "INSERT INTO atividade(tarefa_id,descricao,data_cadatro) VALUES('{$id_tarefa}','{$comentario}',NOW())";
  echo $insert;
  $exec = $pdo->prepare($insert); 
  $exec->execute();

 break;

 
}
