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
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Document</title>
</head>
<body>
    <div id="app">
    
    <nav class="header navbar navbar-expand-lg">
  <div class="container-fluid">
    <h4 class="navbar-brand" >Organize</h4>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search" action="../api/logoff.php">        
        <button class="btn btn-secondary" type="submit">Sair</button>
      </form>
    </div>
  </div>
</nav>

        <div class="sidebar">
          <span style="margin-top: 50PX;"></span>
           <a class="buttonNav" target="iframe" href="quadros.php"><i class="fa fa-list-alt" aria-hidden="true"></i>Quadros</a>
           <?php if($_SESSION['perfil'] == 1){?>
           <a class="buttonNav" target="iframe" href="usuarios.php"><i class="fa fa-users" aria-hidden="true"></i> Usuários</a>
           <?php }?>
        </div>
        <div class="content">
        <iframe name="iframe" id="IdIframe" scrolling="Auto" src="quadros.php" frameborder="0" width="100%"> </iframe>
        </div>       
    </div>

</body>
</html>