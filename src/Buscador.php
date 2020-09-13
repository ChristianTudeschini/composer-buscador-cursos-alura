<?php

namespace ChristianTudeschini\BuscadorCursos;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class Buscador {
    private Client $client;
    private Crawler $crawler;

    public function __construct(Client $client, Crawler $crawler)
    {
        $this->client = $client;
        $this->crawler = $crawler;
    }
    
    public function buscar(string $url): array
    {
        // Fazendo uma requisição (do tipo GET)
        $res = $this->client->request('GET', $url);
        // Pegando o corpo da requisição
        $html = $res->getBody();

        // Adicionando a página que vai ser lida
        $this->crawler->addHtmlContent($html);
        // Filtrando para pegar apenas os cursos que estão na página (por meio dos seletores CSS)
        $elementoCursos = $this->crawler->filter('span.card-curso__nome');
        $cursos = [];

        foreach ($elementoCursos as $curso) {
            $cursos[] = $curso->textContent;
        }

        return $cursos;
    }
}
