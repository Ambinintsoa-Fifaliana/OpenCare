<?php 
if (session_status() === PHP_SESSION_NONE){
    session_start();
}
/* Génération du token CSRF
if (empty($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // token en 64 caractères
}

if (empty($_SESSION['lang'])){
    $_SESSION['lang'] = 'en';
}*/
?>