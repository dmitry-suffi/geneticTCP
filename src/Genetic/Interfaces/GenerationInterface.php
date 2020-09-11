<?php

declare(strict_types=1);

namespace src\Genetic\Interfaces;

/**
 * "Поколение"
 *
 * Interface GenerationInterface
 * @package src\Genetic\Interfaces
 */
interface GenerationInterface extends \Countable
{
    /**
     * Список особей
     * @return IndividualInterface[]
     */
    public function individuals(): array;

    /**
     * Добавление особей
     * Может содержать проверку на уникальность и в этом случае не добавлять
     * @param IndividualInterface $individual
     * @return bool
     */
    public function add($individual): bool;

    /**
     * Удаление особи
     * @param IndividualInterface $individual
     */
    public function remove($individual);

    /**
     * Получение по $uuid
     * @param $uuid
     * @return IndividualInterface|null
     */
    public function get($uuid);

    /**
     * Проверка на нахождение особи в поколении
     * @param IndividualInterface $individual
     * @return bool
     */
    public function has($individual): bool;
}
