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
 * 
 * $HeadURL$
 * $Revision$
 * $Author$
 * $Date$
 * $Id$
 * 
 */

namespace picon\core;

/**
 * ApplicationInitialiser works like a bootstrap. This is the first step
 * in the Picon application and performs the following:
 * 
 * <ul><li>Registers handlers for auto auto loading classes and error handling</li>
 * <li>Loads, validates and pareses the xml configuration into a config object</li>
 * <li>Loads the page map</li>
 * <li>Instantiates and injects resources</li></ul>
 * 
 * @author Martin Cassidy
 * @package core
 */
abstract class ApplicationInitializer
{
    const CONFIG_RESOURCE_NAME = 'picon_config';

    public function __construct()
    {
    }
    
    /**
     * Initialise the application
     */
    public abstract function initialise();
}

?>
