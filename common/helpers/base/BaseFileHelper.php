<?php
namespace bl\slider\common\helpers\base;

/**
 * BaseFileHelper provides concrete implementation for [[File]].
 *
 * Do not use BaseFileHelper. Use [[File]] instead.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class BaseFileHelper
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
        return sprintf("%s/%s", $rootPath, $fileName);
    }
}