<?php

declare(strict_types=1);

namespace src\Algorythm;

/**
 * История
 * Class History
 */
class History implements HistoryInterface
{
    private $data = [];

    private $current = 0;

    /**
     * {@inheritdoc}
     */
    public function set(string $name, $value)
    {
        $this->data[$this->current][$name] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $this->current++;
    }

    /**
     * {@inheritdoc}
     */
    public function lasts(int $count = 1): array
    {
        return \array_slice($this->data, -$count);
    }

    /**
     * {@inheritdoc}
     */
    public function all(): array
    {
        return $this->data;
    }
}
