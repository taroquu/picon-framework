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

namespace picon\core\xml;

use picon\core\xml\XmlElement;
use picon\core\domain\CommonDomainBase;

/**
 * A comment element of an xml document
 * 
 * @author Martin Cassidy
 * @package domain/xml
 */
class Comment extends CommonDomainBase implements XmlElement
{
    private $comment;
    
    public function __construct($comment)
    {
        $this->comment = $comment;
    }
}

?>
