<?php

declare(strict_types=1);

namespace src\Genetic\Interfaces;

/**
 * Селекция поколения
 *
 * Interface SelectionInterface
 * @package src\Genetic\Interfaces
 */
interface SelectionInterface
{
    /**
     *
     * @param GenerationInterface $generation
     * @return GenerationInterface
     */
    public function select($generation);
}
