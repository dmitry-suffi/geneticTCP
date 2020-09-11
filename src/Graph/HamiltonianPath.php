<?php

declare(strict_types=1);

namespace src\Graph;

class HamiltonianPath extends Path
{
    protected array $vertex = [];

    public function addEdge(Edge $edge): bool
    {
        foreach ($this->vertex as $v) {
            if ($v->getName() === $edge->getOut()->getName()) {
                return false;
            }
        }

        $res = parent::addEdge($edge);
        if ($res) {
            $this->vertex[] = $edge->getOut();
        }
        return $res;
    }
}
