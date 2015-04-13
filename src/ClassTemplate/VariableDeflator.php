<?php
namespace ClassTemplate;
use ClassTemplate\Raw;
use ClassTemplate\Exportable;

class VariableDeflator
{
    static public function deflate($var) 
    {
        // Raw string output
        if (is_string($arg) && $arg[0] == '$') {
            return $arg;
        } else if ($arg instanceof Renderable) {
            return $arg->render($args);
        } else if ($arg instanceof Raw) {
            return $arg;
        } else if ($arg instanceof Exportable || method_exists($arg, "__get_state")) {
            return var_export($arg->__get_state(), true);
        } else if (is_array($arg) || method_exists($arg,"__set_state") || is_scalar($arg)) {
            return var_export($arg, true);
        } else {
            throw new LogicException("Can't deflate variable");
        }
    }
}



