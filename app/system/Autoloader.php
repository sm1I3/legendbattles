<?php

namespace app\system;


class Autoloader
{
    static public function loader($className)
    {
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        if (file_exists($fileName)) {
            include($fileName);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }
}

spl_autoload_register('Autoloader::loader');