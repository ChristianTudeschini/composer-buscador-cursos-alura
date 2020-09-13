<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

// Instanciando o Client
$client = new Client(['verify' => false]);
// Fazendo uma requisição (do tipo GET)
$res = $client->request('GET', 'https://www.alura.com.br/cursos-online-programacao');
// Pegando o corpo da requisição
$html = $res->getBody();

// Instanciando o Crawler (para podermos pegar o conteúdo HTML da página)
$crawler = new Crawler();
// Adicionando a página que vai ser lida
$crawler->addHtmlContent($html);
// Filtrando para pegar apenas os cursos que estão na página (por meio dos seletores CSS)
$cursos = $crawler->filter('span.card-curso__nome');

foreach($cursos as $curso) {
    echo $curso->textContent . PHP_EOL;
}