<?php

declare(strict_types=1);

namespace src\Algorythm;

use Psr\Log\LoggerInterface;
use src\Genetic\Interfaces\FitnessInterface;
use src\Genetic\Interfaces\GenerationInterface;

/**
 * Контекст алгоритма
 * Interface ContextInterface
 */
interface ContextInterface
{
    /**
     * Поколение, с которым работает алгоритм
     * @return GenerationInterface
     */
    public function getGeneration(): GenerationInterface;

    /**
     * Поколение, с которым работает алгоритм
     * @param GenerationInterface $generation
     * @return mixed
     */
    public function setGeneration(GenerationInterface $generation);

    /**
     * Функция приспособления
     * @return FitnessInterface
     */
    public function getFitness(): FitnessInterface;

    /**
     * Параметр алгоритма
     * @param string $key
     * @param null|mixed $default
     * @return mixed
     */
    public function getParameter(string $key, $default = null);

    /**
     * Параметр алгоритма
     * @param string $key
     * @param mixed $value
     */
    public function setParameter(string $key, $value);

    /**
     * Логгер
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface;

    /**
     * Получение истории
     * @return HistoryInterface
     */
    public function getHistory(): HistoryInterface;

    /**
     * Остановка алгоритма
     * @return void
     */
    public function stop(): void;
}
