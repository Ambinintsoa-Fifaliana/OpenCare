<?php
    require_once __DIR__ . "/../App/session.php";
    
    $_SESSION = [];
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/');
    
    header("Location: login.php");
    exit;
?>