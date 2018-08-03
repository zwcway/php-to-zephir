<?php
namespace PhpToZephir;

use PhpParser\NodeAbstract;

class NodeFetcher
{
    /**
     * @return array
     *
     * @param mixed        $nodesCollection
     * @param array        $nodes
     * @param array|string $parentClass
     *
     * @param bool         $includeClosure
     */
    public function foreachNodes(
        $nodesCollection,
        array $nodes = [],
        array $parentClass = [],
        $includeClosure = false
    ) {
        if (is_object($nodesCollection) === true && $nodesCollection instanceof NodeAbstract) {
            $valueClassName = $nodesCollection->getType();
            $parentClassName = $this->getParentClass($nodesCollection);
            if ($includeClosure || $valueClassName !== 'Expr_Closure' || strpos($parentClassName,
                    'Closure') === false
            ) {
                foreach ($nodesCollection->getSubNodeNames() as $subNodeName) {
                    $parentClass[] = $parentClassName;
                    $nodes = $this->fetch($nodesCollection->$subNodeName, $nodes, $parentClass, false, $includeClosure);
                }
            }
        } elseif (is_array($nodesCollection) === true) {
            $nodes = $this->fetch($nodesCollection, $nodes, $parentClass, false, $includeClosure);
        }

        return $nodes;
    }

    /**
     * @param         $nodeToFetch
     * @param         $nodes
     * @param         $parentClass
     * @param boolean $addSelf
     * @param boolean $includeClosure
     *
     * @return array
     */
    private function fetch($nodeToFetch, $nodes, $parentClass, $addSelf = false, $includeClosure = false)
    {
        if (is_array($nodeToFetch) === false) {
            $nodeToFetch = [$nodeToFetch];
        }

        foreach ($nodeToFetch as &$node) {
            $nodes[] = ['node' => $node, 'parentClass' => $parentClass];
            if ($addSelf === true) {
                $parentClass[] = $this->getParentClass($node);
            }
            $nodes = $this->foreachNodes($node, $nodes, $parentClass, $includeClosure);
        }

        return $nodes;
    }

    /**
     * @param mixed $node
     *
     * @return string
     */
    private function getParentClass($node)
    {
        return is_object($node) ? get_class($node) : '';
    }
}
