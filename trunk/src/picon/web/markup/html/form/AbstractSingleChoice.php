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
 * Description of AbstractSingleChoice
 * 
 * @author Martin Cassidy
 */
abstract class AbstractSingleChoice extends AbstractChoice
{
    public function isSelected($choice, $index)
    {
        if($this->isEmptyInput())
        {
            return false;
        }
        else
        {
            $raw = $this->getRawInput();
            if(!empty($raw))
            {
                return $this->getRawInput()==$this->getChoiceRenderer()->getValue($choice, $index);
            }
            else
            {
                return $this->getModelObjectAsString()==$this->getChoiceRenderer()->getValue($choice, $index);
            }
        }
    }
    
    protected function convertInput()
    {
        $value = $this->getRawInput();
        foreach($this->getChoices() as $index => $choice)
        {
            if($this->valueForChoice($choice, $value, $index))
            {
                $this->setConvertedInput($choice);
                return;
            }
        }
    }
}

?>