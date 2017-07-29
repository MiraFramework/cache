<?php

namespace Mira\Cache;

class Cache
{
    public static $storage;

    public function store($key, $data)
    {
        return file_put_contents(static::getStorage()."/".md5($key).".php", serialize($data));
    }

    public function has($key)
    {
        if (file_exists(static::getStorage()."/".md5($key).".php")) {
            return true;
        }
        return false;
    }

    public function get($key)
    {
        return unserialize(file_get_contents(static::getStorage()."/".md5($key).".php"));
    }

    public static function setStorage($location)
    {
        static::$storage = $location;
    }

    public static function getStorage()
    {
        if (isset(static::$storage)) {
            return static::$storage;
        }

        return $_SERVER['DOCUMENT_ROOT']."/application/providers/cache";
    }
}
