<?php

declare(strict_types=1);

namespace src\Genetic;

use src\Genetic\Interfaces\IndividualInterface;
use src\Graph\Path;

class Individual implements IndividualInterface
{
    protected $uuid = '';

    private Path $way;

    /**
     * Individual constructor.
     * @param Path $way
     */
    public function __construct(Path $way)
    {
        $this->way = $way;
    }

    public function getUuid()
    {
        if (!$this->uuid) {
            $this->uuid = \bin2hex(\random_bytes(10));
        }
        return $this->uuid;
    }

    /**
     * @return Path
     */
    public function getWay(): Path
    {
        return $this->way;
    }
}
