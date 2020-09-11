<?php

declare(strict_types=1);

namespace src\Graph;

class Path
{
    /** @var Edge[]  */
    private array $edges = [];

    /**
     * @return array
     */
    public function getEdges(): array
    {
        return $this->edges;
    }

    public function getLength(): int
    {
        return count($this->edges);
    }

    public function getMetric()
    {
        $m = 0;
        foreach ($this->edges as $edge) {
            $m += $edge->getMetric();
        }
        return $m;
    }

    public function addEdge(Edge $edge): bool
    {
        if (count($this->edges)) {
            $last = $this->edges[array_key_last($this->edges)];
            if ($last->getIn() !== $edge->getOut()) {
                return false;
            }
        }

        $this->edges[] = $edge;
        return true;
    }

    public function print(): string
    {
        $s = '';
        foreach ($this->edges as $edge)
        {
            $s .= $edge->getOut()->getName() . ' -> ';
        }
        $s .= $edge->getIn()->getName();
        return $s;
    }
}
