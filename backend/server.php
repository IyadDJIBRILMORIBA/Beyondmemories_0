<?php

// Serveur interne PHP avec CORS pour fichiers statiques

$path = __DIR__ . '/public' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Si c'est un fichier statique qui existe :
if ($path !== __DIR__ . '/public' && file_exists($path)) {
    // Ajouter les headers CORS
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    header("Access-Control-Allow-Headers: *");

    return readfile($path);
}

// Sinon, router normal Laravel
require_once __DIR__ . '/public/index.php';
