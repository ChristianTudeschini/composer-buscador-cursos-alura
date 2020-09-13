<?php

require 'vendor/autoload.php';

use ChristianTudeschini\BuscadorCursos\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

// Instanciando o Client
$client = new Client(['base_uri' => 'https://www.alura.com.br/','verify' => false]);
// Instanciando o Crawler (para podermos pegar o conteúdo HTML da página)
$crawler = new Crawler();

$buscador = new Buscador($client, $crawler);
$cursos = $buscador->buscar('cursos-online-programacao');

foreach($cursos as $curso) {
    exibeMensagem($curso);
}