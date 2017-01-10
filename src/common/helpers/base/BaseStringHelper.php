<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\slider\common\helpers\base;

use yii\helpers\FileHelper;

/**
 * `BaseStringHelper` provides concrete implementation for `String`.
 *
 * Do not use `BaseStringHelper`. Use `String` instead.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class BaseStringHelper
{
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

        return FileHelper::normalizePath($url, "/");
    }
}