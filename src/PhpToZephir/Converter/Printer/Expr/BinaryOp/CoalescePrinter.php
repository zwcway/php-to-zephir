<?php
namespace PhpToZephir\Converter\Printer\Expr\BinaryOp;

use PhpParser\Node\Expr\BinaryOp;
use PhpToZephir\Converter\SimplePrinter;

class CoalescePrinter extends SimplePrinter
{
    public static function getType()
    {
        return 'pExpr_BinaryOp_Coalesce';
    }

    public function convert(BinaryOp\Coalesce $node)
    {
		$left = $this->dispatcher->p($node->left);
        return 'isset('.$left.') && '.$left.' !== null ? '.$left.' : '.$this->dispatcher->p($node->right);
    }
}
