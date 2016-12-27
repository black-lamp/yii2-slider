<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\slider\common\helpers\base;

/**
 * `BaseFileHelper` provides concrete implementation for `File`.
 *
 * Do not use `BaseFileHelper`. Use `File` instead.
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
        $name = abs(crc32($name . microtime()));

        if($prefix === null) {
            return static::getFileName($name, $extension);
        }

        return static::getFileName($name, $extension, $prefix);
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
        return static::normalizePath(sprintf("%s/%s", $rootPath, $fileName));
    }

    /**
     * Getting substring by separator
     * ```php
     * $path = 'some/test/path/to/file.php';
     * File::substrBySeparator($path, 'test'); // Return 'path/to/file.php'
     * ```
     * 
     * @param string $path
     * @param string $separator
     * @return string
     */
    public static function substrBySeparator($path, $separator)
    {
        $index = strpos($path, $separator);
        $url = substr($path, $index + strlen($separator));

        return static::normalizePath($url, "/");
    }
}