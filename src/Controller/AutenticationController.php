<?php

use src\Service\AuthenticateManager;

require_once __DIR__."/../../autoload.php";
require_once "bootstrap.php";

$aut = new AuthenticateManager($entityManager);

$email = "andre@empresa1";
$password = "SenhaValida1@";

if ( $aut->createAccount($email, $password ) ) {
    echo "\n Usuario criado \n\n";
}else {
    echo "\n Nao conseguiu criar usuario  \n\n";
}

if ( $aut->authenticate($email, $password ) ) {
    echo "\n Usuario autenticado \n\n";
}else {
    echo "\n Nao conseguiu autenticar usuario  \n\n";
}



?>