<?php

function debuguear($variable) : string {
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

//funciones que revisa que el usuario este autenticado.
function isAuth() : void {
    //code...
    if(!isset($_SESSION['login'])){
        echo "<script>location.href='/';</script>";
    }
}

function isAdmin() : void{
    //code...
    if(!isset($_SESSION['Admin'])){
        echo "<script>location.href='/';</script>";
    }
}

//funciones especializada para hacer una análisis del total a pagar.
function esUltimo($inicio, $final){
    //code...
    if($inicio !== $final){
        return true;
    }   
    return false;
}