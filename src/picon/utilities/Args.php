<?php

/**
 * Picon Framework
 * http://code.google.com/p/picon-framework/
 *
 * Copyright (C) 2011-2012 Martin Cassidy <martin.cassidy@webquub.com>

 * Picon Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * Picon Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with Picon Framework.  If not, see <http://www.gnu.org/licenses/>.
 * */

namespace picon;

/**
 * Generic helper class for validating method arguments
 *
 * @author Martin Cassidy
 */
class Args
{
    /**
     * Throws and excpetion if not a callback
     * @param mixed $object The object to test
     */
    public static function callBack($object, $argName)
    {
        if(!is_callable($object))
        {
            throw new \InvalidArgumentException(sprintf("%s expected argument %s to be callable", self::getCallingMethod(), $argName));
        }
    }
    
    /**
     * Throws an exception if the callback does not accept the required number of
     * arguments
     * @param Closure $callback The callback to test
     * @param int $amount The number of arguments the callback should have
     */
    public static function callBackArgs($callback, $amount, $argName)
    {
        self::isNumeric($amount, 'amount');
        
        if(!is_callable($callback))
        {
            throw new \InvalidArgumentException(sprintf("%s expected argument %s to be callable", self::getCallingMethod(), $argName));
        }
        
        $reflection = new \ReflectionFunction($callback);
        if(count($reflection->getParameters())!=$amount)
        {
            throw new \InvalidArgumentException(sprintf("%s expected argument %s to be callable and take %d argument(s)", self::getCallingMethod(), $argName, $amount));
        }
    }
    
    /**
     * Throws an exception if not numeric
     * @param type $number 
     */
    public static function isNumeric($number, $argName)
    {
        if(!is_numeric($number))
        {
            throw new \InvalidArgumentException(sprintf("%s expected argument %s to be numeric", self::getCallingMethod(), $argName));
        }
    }
    
    public static function isArray($object, $argName)
    {
        if(!is_array($object))
        {
            throw new \InvalidArgumentException(sprintf("%s expected argument %s to be an array", self::getCallingMethod(), $argName));
        }
    }
    
    public static function isString($object, $argName)
    {
        if(!is_string($object))
        {
            throw new \InvalidArgumentException(sprintf("%s expected argument %s to be a string", self::getCallingMethod(), $argName));
        }
    }
    
    public static function isBoolean($object, $argName)
    {
        if(!is_bool($object))
        {
            throw new \InvalidArgumentException(sprintf("%s expected argument %s to be a boolean", self::getCallingMethod(), $argName));
        }
    }
    
    private static function getCallingMethod()
    {
        $trace = debug_backtrace();
        return $trace[2]['class'].$trace[2]['type'].$trace[2]['function'].'()';
    }
    
    public static function notNull($object, $argName)
    {
        if($object==null)
        {
            throw new \InvalidArgumentException(sprintf("%s expected argument %s to be non null", self::getCallingMethod(), $argName));
        }
    }
}

?>
