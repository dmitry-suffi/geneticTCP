<?php

declare(strict_types=1);

namespace src\Genetic;

use src\Genetic\Interfaces\GenerationInterface;
use src\Genetic\Interfaces\IndividualInterface;

class Generation implements GenerationInterface
{
    /**
     * Список особей
     * @var array
     */
    protected $individuals = [];

    /**
     * {@inheritdoc}
     */
    public function individuals(): array
    {
        return $this->individuals;
    }

    /**
     * {@inheritdoc}
     */
    public function add($individual): bool
    {
        if ($this->has($individual)) {
            return false;
        }
        $this->individuals[$individual->getUuid()] = $individual;
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function remove($individual)
    {
        unset($this->individuals[$individual->getUuid()]);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return \count($this->individuals);
    }

    /**
     * {@inheritdoc}
     */
    public function get($uuid)
    {
        return $this->individuals[$uuid] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function has($individual): bool
    {
        return isset($this->individuals[$individual->getUuid()]);
    }
}
