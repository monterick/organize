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
  <title>Organize</title>
</head>
<style>
  .AppHeader {
    background-color: #09f;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    padding: 10px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, .2);
    color: #fff;
}
</style>
<body>
 
<div class="container-fluid">
<div class="row">
   <header class="AppHeader">
     Organize
   </header>
  </div>
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Menu</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a target="iframe" href="./quadros.php" class="nav-link align-middle px-0">
                             <span class="ms-1 d-none d-sm-inline"><i class="fa fa-list-alt" aria-hidden="true"></i>Quadros</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a target="iframe" href="./usuarios.php" class="nav-link align-middle px-0">
                             <span class="ms-1 d-none d-sm-inline"><i class="fa fa-users" aria-hidden="true"></i> Usuários</span>
                        </a>
                    </li>
                    
                    
                    
                </ul>
                <hr>
                <div>
                
                        <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"  href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                             <span class="ms-1 d-none d-sm-inline"><?=$_SESSION['nome']?></span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="../api/logoff.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Sair</span></a>
                            </li>
                            
                           </ul>
                    
                </div>
                <hr>
                <hr>
           
            </div>
        </div>
        <div class="col py-3">
        <iframe name="iframe" id="IdIframe" scrolling="Auto" src="quadros.php" frameborder="0" width="100%" height="100%"> </iframe>
        </div>
    </div>
</div>
</body>
</html>