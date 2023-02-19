<?php

/* Connect to a MySQL database using driver invocation */
try{
$dsn = 'mysql:dbname=organize;host=127.0.0.1';
$user = 'root';
$password = '224422';


if(!$pdo = new PDO($dsn, $user, $password)){
    throw new \PDOException('Erro na conexão com o banco de dados');
}


}catch(\PDOException $e){
  echo  $e->getMessage();
}
