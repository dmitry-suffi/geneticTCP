<?php

declare(strict_types=1);

namespace src\Algorythm;

/**
 * Интерфейс истории работы алгоритма
 * Interface HistoryInterface
 */
interface HistoryInterface
{
    /**
     * Установка параметра
     * @param string $name
     * @param $value
     */
    public function set(string $name, $value);

    /**
     * Следующий шаг
     */
    public function next();

    /**
     * Получение записей последних $count шагов
     * @param int $count
     * @return array
     */
    public function lasts(int $count = 1): array;

    /**
     * Получение всех записей
     * @return array
     */
    public function all(): array;
}
