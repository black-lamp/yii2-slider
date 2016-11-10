<?php
namespace bl\slider\common\helpers\base;

use bl\slider\common\helpers\Directory;

/**
 * BaseFileHelper provides concrete implementation for [[File]].
 *
 * Do not use BaseFileHelper. Use [[File]] instead.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class BaseFileHelper extends \yii\helpers\BaseFileHelper
{
    /**
     * Build file name
     *
     * @param string $name
     * @param string $extension
     * @param null|string $prefix
     * @return string
     */
    public static function getFileName($name, $extension, $prefix = null)
    {
        if($prefix === null) {
            return sprintf("%s.%s", $name, $extension);
        }

        return sprintf("%s-%s.%s", $prefix, $name, $extension);
    }

    /**
     * Build random filename
     *
     * @param string $name
     * @param string $extension
     * @param null|string $prefix
     * @return string
     */
    public static function getCrc32RandomName($name, $extension, $prefix = null)
    {
        $name = crc32($name . microtime());

        if($prefix === null) {
            return sprintf("%s.%s", $name, $extension);
        }

        return sprintf("%s-%s.%s", $prefix, $name, $extension);
    }

    /**
     * Build path to file
     *
     * @param string $rootPath
     * @param string $fileName
     * @return string
     */
    public static function getPathToFile($rootPath, $fileName)
    {
        $path = self::normalizePath(sprintf("%s/%s", $rootPath, $fileName));
        return $path;
    }

    /**
     * Method for transformation file path to URL
     * 
     * @param string $path
     * @param string $separator
     * @return string
     */
    public static function getUrlToFile($path, $separator)
    {
        $index = strpos($path, $separator);
        $url = substr($path, $index + strlen($separator));

        return self::normalizePath($url, "/");
    }
}