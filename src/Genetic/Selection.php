<?php

declare(strict_types=1);

namespace src\Genetic;

use App\Service\Schedule\Algorithm\Genetic\Fitness\FullFitness;
use src\Genetic\Interfaces\GenerationInterface;
use src\Genetic\Interfaces\SelectionInterface;

class Selection implements SelectionInterface
{
    private Fitness $fitness;

    private int $maxCount;

    /**
     * Selection constructor.
     * @param Fitness $fitness
     */
    public function __construct(int $maxCount, Fitness $fitness)
    {
        $this->maxCount = $maxCount;
        $this->fitness = $fitness;
    }

    /**
     * @param GenerationInterface $generation
     * @return GenerationInterface
     */
    public function select($generation, int $count = 0)
    {
        $fitnessed = [];
        foreach ($generation->individuals() as $individual) {
            $fitnessed[$individual->getUuid()] = $this->fitness->fitness($individual);
        }

        //uasort($fitnessed, [self::class, 'sortCallable']);
        asort($fitnessed);

        $removed = \array_slice($fitnessed, $count ? $count : $this->maxCount, null, true);
        foreach ($removed as $k => $v) {
            $generation->remove($generation->get($k));
        }

        return $generation;
    }

    protected function sortCallable($a, $b): int
    {
        return $this->fitness->fitness($b) - $this->fitness->fitness($a);
    }
}
