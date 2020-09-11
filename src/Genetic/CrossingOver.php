<?php

declare(strict_types=1);

namespace src\Genetic;

use src\Genetic\Interfaces\CrossingOverInterface;
use src\Genetic\Interfaces\FitnessInterface;
use src\Graph\Edge;
use src\Graph\Graph;
use src\Graph\HamiltonianPath;
use src\Graph\Path;

class CrossingOver implements CrossingOverInterface
{
    protected Graph $graph;

    protected FitnessInterface $fitness;

    public function __construct(Graph $graph, FitnessInterface $fitness)
    {
        $this->graph = $graph;
        $this->fitness = $fitness;
    }

    public function generate($generation)
    {
        $fitnessed = [];
        foreach ($generation->individuals() as $individual) {
            $fitnessed[$individual->getUuid()] = $this->fitness->fitness($individual);
        }

        //uasort($fitnessed, [self::class, 'sortCallable']);
        asort($fitnessed);

        $first = $generation->get(array_key_first($fitnessed));

        foreach ($generation->individuals() as $individual) {
            if ($individual->getUuid() !== $first->getUuid()) {
                $generation->add($this->crossingOver($first, $individual));
                $generation->add($this->crossingOver($individual, $first));
            }
        }

        return $generation;
    }

    /**
     * @param Interfaces\IndividualInterface|null $first
     * @param Interfaces\IndividualInterface $individual
     * @return Interfaces\IndividualInterface|null
     */
    protected function crossingOver(?Interfaces\IndividualInterface $first, Interfaces\IndividualInterface $individual): ?Interfaces\IndividualInterface
    {
        /** @var HamiltonianPath $pathX */
        $pathX = $first->getWay();
        /** @var HamiltonianPath $pathY */
        $pathY = $individual->getWay();

        $freeVertex = [];
        foreach ($this->graph->getVertex() as $vertex) {
            $freeVertex[$vertex->getName()] = $vertex;
        }

        $pathChild = new HamiltonianPath();

        $edgesX = array_values($pathX->getEdges());
        $edgesY = array_values($pathY->getEdges());

        $curVertex = $edgesX[0]->getOut();
        unset($freeVertex[$curVertex->getName()]);

        for ($i = 0; $i < count($this->graph->getVertex()) - 1; $i++) {
            if ($pathChild->addEdge($edgesX[$i])) {
                $curVertex = $edgesX[$i]->getIn();
                unset($freeVertex[$curVertex->getName()]);
            } else if ($pathChild->addEdge($edgesY[$i])) {
                $curVertex = $edgesY[$i]->getIn();
                unset($freeVertex[$curVertex->getName()]);
            } else { //rand
                $vertexRand = $freeVertex[array_rand($freeVertex)];
                $found = false;
                /** @var Edge $outEdge */
                foreach ($curVertex->getOutEdges() as $outEdge) {
                    if ($outEdge->getIn() === $vertexRand && $pathChild->addEdge($outEdge)) {
                        $curVertex = $vertexRand;
                        $found = true;
                    }
                }
                if (!$found) {
                    throw new \Exception('dfdfdf');
                }
            }
        }

        $end = false;
        foreach ($curVertex->getOutEdges() as $outEdge) {
            if ($outEdge->getIn() === $edgesX[0]->getOut() && $pathChild->addEdge($outEdge)) {
                $end = true;
            }
        }
        if (!$end) {
            throw new \Exception('dfdfdf');
        }
        return new Individual($pathChild);
    }
}
