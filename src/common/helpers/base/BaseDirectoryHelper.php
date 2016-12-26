<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\slider\common\helpers\base;

/**
 * `BaseDirectoryHelper` provides concrete implementation for `Directory`.
 *
 * Do not use `BaseDirectoryHelper`. Use `Directory` instead.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class BaseDirectoryHelper
{
    /**
     * Check if directory existence
     *
     * @param string $path
     * @return bool returns `true` if directory exists
     */
    public static function isExists($path)
    {
        return file_exists($path);
    }

    /**
     * Create directory
     *
     * @param string $path
     * @param bool $recursive
     * @param bool $force
     * @param int $mode
     * @return bool
     */
    public static function create($path, $recursive = false, $force = false, $mode = 0777)
    {
        if($force) {
            self::delete($path);
        }

        return (!self::isExists($path)) ? mkdir($path, $mode, $recursive) : false;
    }

    /**
     * Delete directory
     *
     * @param string $path
     * @return bool
     */
    public static function delete($path)
    {
        return self::isExists($path) ? rmdir($path) : false;
    }
}