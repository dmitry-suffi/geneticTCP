<?php

declare(strict_types=1);

namespace src\Genetic;

use src\Genetic\Interfaces\MutationInterface;
use src\Graph\Graph;
use src\Graph\PathFactory;

class RandomMutation implements MutationInterface
{
    protected Graph $graph;

    protected int $count = 1;

    /**
     * RandomMutation constructor.
     * @param Graph $graph
     */
    public function __construct(Graph $graph, int $count = 1)
    {
        $this->graph = $graph;
        $this->count = $count;
    }

    public function mutate($generation)
    {
        for ($i = 0; $i < $this->count; $i++) {
            $path = PathFactory::createRandomPath($this->graph);
            $generation->add(new Individual($path));
        }

        return $generation;
    }
}
