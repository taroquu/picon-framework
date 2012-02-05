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
 * A form component which contains a pre-defined list of
 * posible choices
 * 
 * @author Martin Cassidy
 * @package web/markup/html/form
 */
abstract class AbstractChoice extends FormComponent
{
    private $choiceRenderer;
    
    private $choices;
    
    /**
     *
     * @param string $id
     * @param array $choices
     * @param Model $model 
     */
    public function __construct($id, $choices, ChoiceRenderer $choiceRenderer = null, Model $model = null)
    {
        parent::__construct($id, $model);
        Args::isArray($choices, 'choices');
        
        $this->choices = $choices;
        
        if($choiceRenderer==null)
        {
            $choiceRenderer = new ChoiceRenderer();
        }
        $this->choiceRenderer = $choiceRenderer;
    }
    
    protected function getChoiceRenderer()
    {
        return $this->choiceRenderer;
    }
    
    protected function getChoices()
    {
        return $this->choices;
    }
    
    public abstract function isSelected($choice, $index);   
    
    
    /**
     * Render an <option> element
     * @param type $choice 
     */
    protected function renderOption($name, $value, $selected)
    {
        $this->getResponse()->write('<option');
        if($selected)
        {
             $this->getResponse()->write(' selected="selected"');
        }
        $this->getResponse()->write(' value="'.htmlentities($value).'"');

        $this->getResponse()->write('>');
        $this->getResponse()->write(htmlentities($name));
        $this->getResponse()->write('</option>');
    }
    
    protected function renderOptions()
    {
        foreach($this->choices as $index => $choice)
        {
            $selected = $this->isSelected($choice, $index);
            $this->renderOption($this->choiceRenderer->getDisplay($choice, $index), $this->choiceRenderer->getValue($choice, $index), $selected);
        }
    }
    
    protected final function valueForChoice($choice, $value, $index)
    {
        return $this->choiceRenderer->getValue($choice, $index)==$value;
    }
    
    protected function validateModel()
    {
        if(count($this->choices)>0)
        {
            $firstType = null;
            if(is_object($this->choices[0]))
            {
                $firstType = get_class($this->choices[0]);
            }
            else
            {
                $firstType = gettype($this->choices[0]);
            }

            foreach($this->choices as $choice)
            {
                if(is_array($choice))
                {
                    throw new \InvalidArgumentException('Choices array may not contain nested arrays');
                }
                else if((is_object($choice) && get_class($choice)!=$firstType) || (!is_object($choice) && gettype($choice)!=$firstType))
                {
                    //@todo this doesn't actually work as it assumes that classes will be identical but the full hierarchy should be checked
                    //throw new \InvalidArgumentException('Choice array does not contain the same values');
                }       
            }
        }
    }
    
    public function getValue()
    {
        $input = null;
        if($this->disabled)
        {
            $input = $this->getModelObject();
        }
        if($this->rawInput==null)
        {
            if($this->emptyInput==true)
            {
                return null;
            }
            else
            {
                $input = $this->getModelObject();
            }
        }
        else
        {
            $input = $this->rawInput;
        }
        return $input;
    }
}

?>
