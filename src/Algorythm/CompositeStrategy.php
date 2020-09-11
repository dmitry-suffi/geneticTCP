<?php

declare(strict_types=1);

namespace src\Algorythm;

/**
 * Команда - компоновщик команд.
 * Выполняет список команд, на каждом шаге только одну, переходит к следующей команде, если предыдущая неэффективна или исчерпан ее лимит попыток
 * Class CompositeStrategy
 */
class CompositeStrategy extends Strategy
{
    /** @var Strategy[] */
    protected $strategies = [];

    protected $current = 0;

    /**
     * Добавление команды
     * @param Strategy $strategy
     */
    public function addStrategy(Strategy $strategy)
    {
        $this->strategies[] = $strategy;
    }

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $strategy = $this->getStrategy();
        if (null !== $strategy) {
            $strategy->run();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isEnough(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function isExceed(): bool
    {
        if (parent::isExceed()) {
            return true;
        }
        $strategy = $this->getStrategy();
        if (null !== $strategy) {
            // Если стратегия есть, то она точно готова к запуску
            return false;
        }
        return true;
    }

    /**
     * Метод получения текущей команды.
     * Возвращает null, если доступные команды закончились
     * @return Strategy|null
     */
    protected function getStrategy()
    {
        if (isset($this->strategies[$this->current])) {
            $strategy = $this->strategies[$this->current];
            if ($strategy->isExceed() || $strategy->isEnough()) {
                $this->current++;
                return $this->getStrategy();
            } else {
                return $strategy;
            }
        } else {
            return null;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        foreach ($this->strategies as $strategy) {
            $strategy->reset();
        }
        $this->current = 0;
        parent::reset();
    }
}
