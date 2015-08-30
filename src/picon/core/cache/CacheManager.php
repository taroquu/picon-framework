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

namespace picon\core\cache;

use picon\core\Args;
use picon\core\exceptions\CacheException;

/**
 * Helper class for saving and loading resources from the cache.
 * 
 * This can work for both the application and session scope allowing resources
 * to be shared accross sessions
 *
 * @author Martin Cassidy
 */
class CacheManager
{
    const EXTENSION = '.pcx';
    const SESSION_PATH = 'session_data';
    const APPLICATION_PATH = 'application_data';
    const ANNOTATION_PATH = 'annotations';
    
    const APPLICATION_SCOPE = '1';
    const SESSION_SCOPE = '2';
    
    private static $self;

    public static $cacheDirectory;
    
    private function __construct()
    {
        //singleton
    }

    public static function getCacheDirectory()
    {
        if(!isset(self::$cacheDirectory))
        {
            self::$cacheDirectory = sys_get_temp_dir();
        }
        return self::$cacheDirectory;
    }
    
    /**
     * Saves a resource to the cache.
     * @param $name
     * @param $resource
     * @param $scope
     */
    public static function saveResource($name, $resource, $scope)
    {
        Args::isString($name, 'name');
        $instance = self::get();
        $dir = $instance->getDirectoryForScope($scope);
        $instance->internalSaveResource($dir, $name, $resource);
    }
    
    /**
     * Load a previously saved resource. If the resource was not
     * found this will return null
     * @param string $name
     * @param $scope
     * @return mixed
     */
    public static function loadResource($name, $scope)
    {
        $instance = self::get();
        $directory = $instance->getDirectoryForScope($scope);
        return $instance->internalLoadResource($directory, $name);
    }
    
    private static function get()
    {
        if(!isset(self::$self))
        {
            self::$self = new self();
        }
        return self::$self;
    }
    
    private function getDirectoryForScope($scope)
    {
        $dir = null;
        if($scope==self::SESSION_SCOPE)
        {
            $dir = self::get()->getSessionCacheDirectory();
        }
        else if($scope==self::APPLICATION_SCOPE)
        {
            $dir = self::get()->getApplicationCacheDirectory();
        }
        else
        {
            throw new \InvalidArgumentException('Invalid scope argument for saveResource()');
        }
        return $dir;
    }

    public static function getSessionCacheDirectory()
    {
        return self::getCacheDirectory().'/'.self::SESSION_PATH.'/'.session_id().'/';
    }
    
    public static function getApplicationCacheDirectory()
    {
        return self::getCacheDirectory().'/'.self::APPLICATION_PATH.'/';
    }

    public static function getAnnotationCacheDirectory()
    {
        return self::getCacheDirectory().'/'.self::ANNOTATION_PATH.'/';
    }
    
    private function getFileName($directory, $name)
    {
        return $directory.$this->sanitizeFileName($name).self::EXTENSION;
    }
    
    private function internalSaveResource($directory, $name, $resource)
    {
        $fileName = $this->getFileName($directory, $name);
        
        if(!file_exists($directory))
        {
            $success = @mkdir($directory, 0755, true);

            if(!$success)
            {
                throw new CacheException(sprintf("Failed to write to create directory %s", $directory));
            }
        }
        
        file_put_contents($fileName, PiconSerializer::serialize($resource));
    }
    
    private function internalLoadResource($directory, $name)
    {
        $fileName = $this->getFileName($directory, $name);
        
        if(file_exists($fileName))
        {
            $contents = file_get_contents($fileName);
            return PiconSerializer::unserialize($contents);
        }
        else
        {
            return null;
        }
    }
    
    /**
     * Determins whether a resource with that name exists
     * @param $name
     * @param $scope
     * @return
     */
    public static function resourceExists($name, $scope)
    {
        $dir = self::get()->getDirectoryForScope($scope);
        $fileName = self::get()->getFileName($dir, $name);
        
        return file_exists($fileName);
    }
    
    private function sanitizeFileName($fileName)
    {
        return str_replace(':', '_', $fileName);
    }
}

?>
