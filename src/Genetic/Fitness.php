<?php

declare(strict_types=1);

namespace src\Genetic;

use src\Genetic\Interfaces\FitnessInterface;
use src\Genetic\Interfaces\IndividualInterface;

class Fitness implements FitnessInterface
{
    private float $target = 0;

    /**
     * Fitness constructor.
     * @param float|int $target
     */
    public function __construct($target)
    {
        $this->target = $target;
    }

    /**
     * @param Individual $individual
     * @return float
     */
    public function fitness($individual)
    {
        $metric = 0;
        foreach ($individual->getWay()->getEdges() as $edge) {
            $metric += $edge->getMetric();
        }

        return $metric;
    }

    /**
     * @param Individual $individual
     * @return bool
     */
    public function isFitness($individual): bool
    {
        return $this->fitness($individual) <= $this->target;
    }
}
