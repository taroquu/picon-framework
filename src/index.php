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

/**
 * Path to the root picon directory without a trailing slash
 * This is the directory containing PiconApplication
 */
define("PICON_DIRECTORY", __DIR__.'\\picon');

/**
 * Path to the assets directory in which the user
 * created classes reside
 */
define("ASSETS_DIRECTORY", __DIR__.'\\assets');

/**
 * Path to the config directory in which the xml config files
 * reside
 */
define("CONFIG_FILE", __DIR__.'\\config\\picon.xml');

require_once("picon/PiconApplication.php");

/**
 * @todo remove this hard coded value
 */
date_default_timezone_set("Europe/London");

//Begin output buffering
ob_start();

//Create the application
$application = new picon\PiconApplication();
$application->run();

//Flush the output
ob_end_flush();

?>
