<?php

declare(strict_types=1);

namespace src\Graph;

/**
 * Вершина графа
 * Class Vertex
 */
class Vertex
{
    private string $name;

    private array $outEdges = [];

    private array $inEdges = [];

    /**
     * Vertex constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function addOutEdge(Edge $edge)
    {
        $this->outEdges[] = $edge;
    }

    public function addInEdge(Edge $edge)
    {
        $this->inEdges[] = $edge;
    }

    /**
     * @return array
     */
    public function getOutEdges(): array
    {
        return $this->outEdges;
    }

    /**
     * @return array
     */
    public function getInEdges(): array
    {
        return $this->inEdges;
    }
}
