<?php

declare(strict_types=1);

namespace src\Graph;

/**
 * Ребро графа
 * Class Edge
 */
class Edge
{
    private Vertex $out;

    private Vertex $in;

    protected $metric = 0;

    /**
     * Edge constructor.
     * @param Vertex $out
     * @param Vertex $in
     */
    public function __construct(Vertex $out, Vertex $in, float $metric)
    {
        $this->out = $out;
        $this->in = $in;
        $this->metric = $metric;

        $out->addOutEdge($this);
        $in->addInEdge($this);
    }

    /**
     * @return Vertex
     */
    public function getOut(): Vertex
    {
        return $this->out;
    }

    /**
     * @return Vertex
     */
    public function getIn(): Vertex
    {
        return $this->in;
    }

    /**
     * @return float
     */
    public function getMetric(): float
    {
        return $this->metric;
    }
}
