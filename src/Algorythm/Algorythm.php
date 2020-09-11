<?php

declare(strict_types=1);

namespace src\Algorythm;

use Psr\Log\LoggerInterface;
use src\Genetic\Fitness;
use src\Genetic\Generation;
use src\Genetic\Interfaces\FitnessInterface;
use src\Genetic\Interfaces\GenerationInterface;
use src\Genetic\Interfaces\IndividualInterface;
use src\Genetic\Selection;
use src\Graph\Graph;

class Algorythm implements ContextInterface
{

    /** @var Fitness */
    protected $fitness;

    /** @var Generation */
    protected $generation;

    /** @var Selection */
    protected $selection;

    /** @var LoggerInterface */
    protected $logger;

    protected $history;

    protected Graph $graph;

    private $stop = false;

    public function __construct(Graph $graph, Generation $generation, ?LoggerInterface $logger = null, $maxCount)
    {
        $this->graph = $graph;
        $this->generation = $generation;

        $this->fitness = new Fitness(0);
        $this->selection = new Selection($maxCount, $this->fitness);

        $this->logger = $logger;
        $this->history = new History();
    }

    /**
     * @return Graph
     */
    public function getGraph(): Graph
    {
        return $this->graph;
    }

    /**
     * {@inheritdoc}
     */
    public function getGeneration(): GenerationInterface
    {
        return $this->generation;
    }

    /**
     * {@inheritdoc}
     */
    public function setGeneration(GenerationInterface $generation)
    {
        $this->generation = $generation;
    }

    /**
     * {@inheritdoc}
     */
    public function getFitness(): FitnessInterface
    {
        return $this->fitness;
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter(string $key, $default = null)
    {
        //todo
        //return $this->settings->get($key, $default);
    }

    /**
     * {@inheritdoc}
     */
    public function setParameter(string $key, $value)
    {
       // $this->settings->set($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * {@inheritdoc}
     */
    public function getHistory(): HistoryInterface
    {
        return $this->history;
    }

    public function stop(): void
    {
        $this->stop = true;
    }

    /**
     * @return bool
     */
    protected function isStop(): bool
    {
        return $this->stop;
    }

    /**
     * Метод, запускаемый перед запуском алгоритма
     */
    protected function beforeRun(): void
    {
    }

    /**
     * @return IndividualInterface|null
     */
    final public function run(): ?IndividualInterface
    {
        $stepStrategy = $this->makeStrategy();

        $this->beforeRun();

        if (!$stepStrategy->isEnough()) {
            do {
                $stepStrategy->run();
            } while (!$this->isStop() && !$stepStrategy->isExceed() && !$stepStrategy->isEnough());
        }

        $individuals = $this->selection->select($this->generation, 1)->individuals();

        $individual = $individuals[array_key_first($individuals)];
        return $individual;
    }

    protected function makeStrategy(): StrategyInterface
    {
        $stepStrategy = new StepStrategy('Step', $this);

        $str = new COStrategy('co', $this);
        $stepStrategy->addStrategy($str);

        //$stepStrategy->attach($pauseCrossingOverStrategy);
        return $stepStrategy;
    }
}