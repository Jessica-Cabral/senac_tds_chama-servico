<?php
// Configuração de exibição de erros
//error_reporting(~E_ALL & ~E_NOTICE & ~E_WARNING);

// Inclui o autoloader
include_once 'autoload.php';

// Inicia a sessão
session_start();

// Inclui o roteador
include_once 'router.php';