<?php

declare(strict_types=1);

namespace src\Algorythm;


use src\Genetic\CrossingOver;
use src\Genetic\Interfaces\CrossingOverInterface;
use src\Genetic\Interfaces\MutationInterface;
use src\Genetic\Interfaces\SelectionInterface;
use src\Genetic\RandomMutation;
use src\Genetic\Selection;

class COStrategy extends Strategy
{
    protected SelectionInterface $selection;

    /** @var  */
    protected MutationInterface $mutation;

    protected CrossingOverInterface $crossingOver;

    /**
     * {@inheritdoc}
     */
    protected function init()
    {
        parent::init();
        $this->selection = new Selection(4, $this->context->getFitness());
        $this->mutation = new RandomMutation($this->context->getGraph(), 2);
        $this->crossingOver = new CrossingOver($this->context->getGraph(), $this->context->getFitness());

        $this->limit = 100;
    }

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $generation = $this->context->getGeneration();

        $generation = $this->crossingOver->generate($generation);

        // Добавление случайного набора
        $generation = $this->mutation->mutate($generation);

        // Селекция
        $this->context->setGeneration($this->selection->select($generation));
    }

}