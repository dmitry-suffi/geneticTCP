<?php

declare(strict_types=1);

namespace src\Algorythm;

use src\Genetic\Interfaces\IndividualInterface;

/**
 * Шаг алгоритма
 * Class StepStrategy
 */
class StepStrategy extends CompositeStrategy //implements ObservableInterface
{
    //use ObservableTrait;

    protected $min = 999999999999;

    private $step = 1;




    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $this->getHistory()->next();
        //$this->notify();

        $this->context->getLogger()->debug('Шаг ' . $this->step);
        $this->getHistory()->set('step', $this->step);
        $this->step++;

        if (null === $this->getStrategy()) {
            foreach ($this->strategies as $strategy) {
                $strategy->reset();
            }
            $this->current = 0;
        }
        parent::run();
    }

    /**
     * {@inheritdoc}
     */
    public function isEnough(): bool
    {
        return (null !== $this->check());
    }

    /**
     * {@inheritdoc}
     */
    public function isExceed(): bool
    {
        return $this->isExceedLimit();
    }

    /**
     * Проверяет текущее поколение на соответствие функции приспособления
     * и возвращает соответствующую особь либо null, если ни одна не соответствует
     * @return IndividualInterface|null
     */
    protected function check()
    {
        foreach ($this->context->getGeneration()->individuals() as $individual) {
            $fitnesses = $this->context->getFitness()->fitness($individual);

            $this->min = min($this->min, $fitnesses);

            $this->setParameter('min', $this->min);
            if ($this->context->getFitness()->isFitness($individual)) {
                return $individual;
            }
        }

        $this->getHistory()->set('min', $this->min);

        $this->context->getLogger()->debug('min ' . $this->min);
        return null;
    }
}
