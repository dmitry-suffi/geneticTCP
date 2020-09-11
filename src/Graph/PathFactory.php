<?php

declare(strict_types=1);

namespace src\Graph;

class PathFactory
{
    public static function createPath(Graph $graph, int $st = 0, int $sh = 0): HamiltonianPath
    {
        $path = new HamiltonianPath();
        $v = $graph->getVertex();
        $count = count($v);
        /** @var \src\Graph\Vertex $vertex */
        $vertex = $v[array_key_first($v)];
        $beginVertex = $vertex;
        $useVertex = [];
        do {
            $next = false;
            $useVertex[$vertex->getName()] = $vertex;
            $outEdges = $vertex->getOutEdges();
            $length = $path->getLength();
            $cnt = count($outEdges);
            for ($k = 0; $k < $cnt; $k++) {
                $key = ($k + $st) % $cnt;
                /** @var \src\Graph\Edge $edge */
                $edge = $outEdges[$key];
                if ($length < $count - 1) {
                    if (!isset($useVertex[$edge->getIn()->getName()]) && $path->addEdge($edge)) {
                        $vertex = $edge->getIn();
                        $next = true;
                        break;
                    }
                } else {
                    if ($edge->getIn() === $beginVertex && $path->addEdge($edge)) {
                        $vertex = $edge->getIn();
                        $next = true;
                        break;
                    }
                }
            }
            if (!$next) {
                throw new \Exception('dfdf');
            }
            $st += $sh;
        } while ($path->getLength() < $count);

        return $path;
    }

    public static function createRandomPath(Graph $graph): HamiltonianPath
    {
        $path = new HamiltonianPath();
        $v = $graph->getVertex();
        $count = count($v);
        /** @var \src\Graph\Vertex $vertex */
        $vertex = $v[array_key_first($v)];
        $beginVertex = $vertex;
        $useVertex = [];
        do {
            $next = false;
            $useVertex[$vertex->getName()] = $vertex;
            $outEdges = $vertex->getOutEdges();
            shuffle($outEdges);
            $length = $path->getLength();
            $cnt = count($outEdges);
            for ($k = 0; $k < $cnt; $k++) {
                $key = ($k) % $cnt;
                /** @var \src\Graph\Edge $edge */
                $edge = $outEdges[$key];
                if ($length < $count - 1) {
                    if (!isset($useVertex[$edge->getIn()->getName()]) && $path->addEdge($edge)) {
                        $vertex = $edge->getIn();
                        $next = true;
                        break;
                    }
                } else {
                    if ($edge->getIn() === $beginVertex && $path->addEdge($edge)) {
                        $vertex = $edge->getIn();
                        $next = true;
                        break;
                    }
                }
            }
            if (!$next) {
                throw new \Exception('dfdf');
            }
        } while ($path->getLength() < $count);

        return $path;
    }
}
