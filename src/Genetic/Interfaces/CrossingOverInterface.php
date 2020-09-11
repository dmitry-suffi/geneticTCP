<?php

declare(strict_types=1);

namespace src\Genetic\Interfaces;

/**
 * Изменение поколения путем скрещивания
 *
 * Interface CrossingOverInterface
 * @package src\Genetic\Interfaces
 */
interface CrossingOverInterface
{
    /**
     * Генерирует новое поколение путем скрещивания
     * @param GenerationInterface $generation
     * @return GenerationInterface
     */
    public function generate($generation);
}
