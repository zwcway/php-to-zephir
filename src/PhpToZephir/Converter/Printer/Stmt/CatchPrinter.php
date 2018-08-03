<?php
namespace PhpToZephir\Converter\Printer\Stmt;

use PhpParser\Node\Stmt;
use PhpToZephir\Converter\SimplePrinter;

class CatchPrinter extends SimplePrinter
{
    /**
     * @return string
     */
    public static function getType()
    {
        return 'pStmt_Catch';
    }

    /**
     * @param Stmt\Catch_ $node
     *
     * @return string
     */
    public function convert(Stmt\Catch_ $node)
    {
        $exceptions = [];
        foreach ($node->types as $type) {
            $exceptions[] = $this->dispatcher->p($type);
        }

        return ' catch ' . implode('|', $exceptions) . ', ' . $node->var . ' {'
            . $this->dispatcher->pStmts($node->stmts) . "\n" . '}';
    }
}
