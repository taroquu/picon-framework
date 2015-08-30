<?php
/**
 * Picon Framework
 * http://piconframework.com
 *
 * Copyright (C) 2011-2015 Martin Cassidy <martin.cassidy@webquub.com>

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

namespace picon\test\core;

use mindplay\annotations\AnnotationCache;
use mindplay\annotations\Annotations;
use picon\context\AutoContextLoader;
use picon\core\ApplicationInitializer;
use picon\core\ConfigLoader;
use picon\core\Picon;

abstract class AbstractPiconUnitTest extends \PHPUnit_Framework_TestCase
{
    protected function getConfig()
    {
        return ConfigLoader::load(__DIR__.'/../../../config/picon.xml');
    }

    protected function getContext()
    {
        $loader = new AutoContextLoader();
        return $loader->load($this->getConfig());
    }
}