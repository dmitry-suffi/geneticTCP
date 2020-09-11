<?php

declare(strict_types=1);

namespace src\Genetic\Interfaces;

/**
 * Мутация
 * Interface MutationInterface
 * @package src\Genetic\Interfaces
 */
interface MutationInterface
{
    /**
     * Функция изменения
     * @param GenerationInterface $generation
     * @return GenerationInterface
     */
    public function mutate($generation);
}
