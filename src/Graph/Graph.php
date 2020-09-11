<?php

declare(strict_types=1);

namespace src\Graph;

class Graph
{
    private array $vertex = [];

    private array $edges = [];

    /**
     * Graph constructor.
     */
    public function __construct()
    {
        $this->vertex = [];
        $this->edges = [];
    }

    public function addVertex(Vertex $vertex)
    {
        $this->vertex[] = $vertex;
    }

    public function addEdge(Edge $edge)
    {
        $this->edges[] = $edge;
    }

    /**
     * @return array
     */
    public function getVertex(): array
    {
        return $this->vertex;
    }

    /**
     * @return array
     */
    public function getEdges(): array
    {
        return $this->edges;
    }
}
