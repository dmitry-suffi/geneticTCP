<?php

declare(strict_types=1);

namespace src\Genetic\Interfaces;

/**
 * "Особь"
 *
 * Interface IndividualInterface
 * @package src\Genetic\Interfaces
 */
interface IndividualInterface
{
    /**
     * Уникальный индекс особи
     * @return mixed
     */
    public function getUuid();
}
