<?php

function formatear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function isAuth() : void{
    if( !isset( $_SESSION['autenticado'] )){
        header( 'Location: /');
    }
}

function isLast(String $actual, String $ultimo): bool{

    if( $actual !== $ultimo ){
        return true;
    }
    return false;
}

function isAdmin(){
    if( !isset($_SESSION['admin'])){
        header('Location: /');
    }
}