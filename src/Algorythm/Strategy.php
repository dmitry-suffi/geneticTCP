<?php

declare(strict_types=1);

namespace src\Algorythm;

/**
 * Общий класс команды
 * Class Strategy
 */
abstract class Strategy implements StrategyInterface
{
    /** @var ContextInterface  */
    protected $context;

    protected $limit = 0; //@todo private

    private $executed = 0;

    private $name = '';

    protected $generationKeys = [];

    private $enough = false;

    /**
     * Strategy constructor.
     * @param $context
     */
    final public function __construct(string $name, ContextInterface $context)
    {
        $this->name = $name;
        $this->context = $context;
        $this->init();
    }

    /**
     * Инициализация
     */
    protected function init()
    {
        $this->limit = $this->getParameter($this->getName() . '.limit', 1);

        //@todo
        $this->limit = 100000;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Получение параметра
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    protected function getParameter(string $key, $default = null)
    {
        return $this->context->getParameter($key, $default);
    }

    /**
     * Установка параметра
     * @param string $key
     * @param mixed $value
     */
    protected function setParameter(string $key, $value)
    {
        return $this->context->setParameter($key, $value);
    }

    /**
     * История
     * @return HistoryInterface
     */
    protected function getHistory(): HistoryInterface
    {
        return $this->context->getHistory();
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->executed = 0;
        $this->enough = false;
    }

    /**
     * {@inheritdoc}
     */
    public function isExceed(): bool
    {
        return $this->isExceedLimit();
    }

    /**
     * {@inheritdoc}
     */
    public function isEnough(): bool
    {
        return $this->enough;
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $this->beforeHandle();
        if ($this->isExceed() || $this->isEnough()) {
            throw new \Exception("Нельзя выполнять команду");
        }
        $this->handle();
        $this->executed++;

        $this->afterHandle();
    }

    private function beforeHandle(): void
    {
        $this->context->getLogger()->debug('Запущена команда ' . get_class($this));
        $this->getHistory()->set('strategy', get_class($this));

        $generation = $this->context->getGeneration();
        $this->generationKeys = array_keys($generation->individuals());
    }

    private function afterHandle(): void
    {
        $generation = $this->context->getGeneration();
        /** Если набор не изменился, то выставляем флаг завершения */
        $newKeys = array_keys($generation->individuals());        ;
        if (count($newKeys) === count($this->generationKeys) && array_diff($newKeys, $this->generationKeys) === []) {
            $this->enough = true;
        }
        $this->generationKeys = $newKeys;
    }


    /**
     * Метод исполнения команды
     */
    abstract protected function handle();

    /**
     * @return bool
     */
    protected function isExceedLimit(): bool
    {
        return ($this->executed >= $this->limit);
    }
}
