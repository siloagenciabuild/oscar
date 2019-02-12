<?php

require_once __DIR__ . '/services/movieVoteService.php';

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'PUT':
        
        break;

    case 'POST':
        $value = movieVoteService::getInstance()->vote($_POST['vote']);
        $votos = movieVoteService::getInstance()->getFilmes();
        $votos = json_encode($votos, JSON_PRETTY_PRINT);
        print $votos;
        break;

    case 'GET':
        $votos = movieVoteService::getInstance()->getFilmes();
        $votos = json_encode($votos, JSON_PRETTY_PRINT);
        print $votos;
        break;

    case 'HEAD':
        echo 'HEAD';
        break;

    case 'DELETE':
        
        break;

    case 'OPTIONS':
        echo 'OPTIONS';
        break;

    default:
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        die('{ "msg" : "Método não encontrado." }');
        break;
}