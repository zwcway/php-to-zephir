<?php
namespace PhpToZephir\Converter\Printer;

use PhpParser\Node\Expr\Variable;
use PhpToZephir\Converter\SimplePrinter;

class EncapsListPrinter extends SimplePrinter
{
    public static function getType()
    {
        return 'pEncapsList';
    }

    public function convert(array $encapsList, $quote)
    {
        $return = '';
        foreach ($encapsList as $element) {

	        if ($element instanceof Variable)
	        {
		        $return .= '{' . $this->dispatcher->p($element) . '}';
	        }
	        else // string part
	        {
		        $return .= addcslashes($element->value, "\n\r\t\f\v$".$quote.'\\');;
	        }
        }

        return $return;
    }
}
