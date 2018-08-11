<?php declare(strict_types=1);
class D
{
    public static $vars = ['a', 'b', 'c'];
    public static $single = 1;
    public static function getVars()
    {
        return self::$vars;
    }
    public static function danger()
    {
        return $_GET[self::$vars[1]];
    }
}
