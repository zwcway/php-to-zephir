<?php
namespace PhpToZephir\Converter\Printer\Stmt;

use PhpParser\Node\Stmt;
use PhpToZephir\Converter\SimplePrinter;

class NopPrinter extends SimplePrinter
{
    public static function getType()
    {
        return 'pStmt_Nop';
    }

    public function convert(Stmt\Nop $node)
    {
        return '/* NOP */ ';
    }
}
