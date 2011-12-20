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
 * Description of ValidatableFormComponentWrapper
 * @author Martin Cassidy
 */
class ValidatableFormComponentWrapper implements Validatable
{
    private $wrappedComponet;
    
    public function __construct(FormComponent &$component)
    {
        $this->wrappedComponet = $component;
    }
    
    /**
     * @todo should take in a validation message not a string, 
     * message will store a locator to get the message from a file
     * @param type $message 
     */
    public function error($message)
    {
        $this->wrappedComponet->error($this->wrappedComponet->getId().' '.$message);
        $this->wrappedComponet->invalid();
    }
    
    public function getValue()
    {
        return $this->wrappedComponet->getConvertedInput();
    }
    
    public function isValid()
    {
        return $this->wrappedComponet->isValid();
    }
}

?>