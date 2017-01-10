<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace tests\unit\helpers;

use tests\unit\TestCase;

use bl\slider\common\helpers\StringHelper;

/**
 * Test case for String helper
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class StringHelperTest extends TestCase
{
    public function testSubstrBySeparator()
    {
        $path = 'this/is/test/path/to';
        $separator = 'test';

        $expectedPath = '/path/to';
        $actualPath = StringHelper::substrBySeparator($path, $separator);

        $this->assertInternalType('string', $actualPath, 'Method should return a string');
        $this->assertEquals($expectedPath, $actualPath, 'Method must cut string by separator');
    }
}