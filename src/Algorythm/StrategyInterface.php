<?php

declare(strict_types=1);

namespace src\Algorythm;

/**
 * Интерфейс команды
 * Interface StrategyInterface
 */
interface StrategyInterface
{
    /**
     * Выполнение команды
     * Метод ДОЛЖЕН бросать исключение Exception, //@todo
     * если исчерпаны попытки или команду выполнять достаточно
     * @return mixed
     */
    public function run();

    /**
     * Сброс попыток выполнения
     * @return mixed
     */
    public function reset();

    /**
     * Проверка на переполнение попыток выполнения
     * @return bool
     */
    public function isExceed(): bool;

    /**
     * Проверка, что выполнять команду достаточно
     * Показывает, что дальнейшее выполнение команды неэффективно
     * @return bool
     */
    public function isEnough(): bool;

    /**
     * Название команды
     * @return string
     */
    public function getName(): string;
}
