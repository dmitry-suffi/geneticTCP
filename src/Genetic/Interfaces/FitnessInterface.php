<?php

declare(strict_types=1);

namespace src\Genetic\Interfaces;

/**
 * Целевая функция для оценки приспособленности
 *
 * Interface FitnessInterface
 * @package src\Genetic\Interfaces
 */
interface FitnessInterface
{
    /**
     * Значение целевой функции приспособленности
     *
     * @param IndividualInterface $individual
     * @return mixed целое или дробное число
     */
    public function fitness($individual);

    /**
     * Соответствие целевой функции приспособленности искомым значениям
     *
     * @param IndividualInterface $individual
     * @return bool
     */
    public function isFitness($individual): bool;
}
