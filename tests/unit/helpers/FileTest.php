<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace tests\unit\helpers;

use bl\slider\common\helpers\File;
use tests\unit\TestCase;

/**
 * Test case for File helper
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class FileTest extends TestCase
{
    private $path = 'test/path/to';
    private $name = 'file';
    private $extension = 'test';


    public function testGetFileName()
    {
        $expectedFileName = $this->name . '.' . $this->extension;
        $actualFileName = File::getFileName($this->name, $this->extension);

        $this->assertInternalType('string', $actualFileName, 'Method should return a string');
        $this->assertEquals($expectedFileName, $actualFileName, 'Method should return a file name');

        $prefix = 't';

        $expectedFileName = $prefix . '-' . $this->name . '.' . $this->extension;
        $actualFileName = File::getFileName($this->name, $this->extension, $prefix);

        $this->assertInternalType('string', $actualFileName, 'Method should return a string');
        $this->assertEquals($expectedFileName, $actualFileName, 'Method should return a file name with a prefix');
    }

    public function testGetCrc32RandomName()
    {
        $fileName = File::getCrc32RandomName($this->name, $this->extension);
        $pattern = "/^[0-9]{0,}\.($this->extension)$/";

        $this->assertInternalType('string', $fileName, 'Method should return a string');
        $this->assertRegExp($pattern, $fileName, 'Method must return a file name');
    }

    public function testGetPathToFile()
    {
        $fileName = $this->name . '.' . $this->extension;

        $expectedPath = File::normalizePath($this->path . '/' . $fileName);
        $actualPath = File::getPathToFile($this->path, $fileName);

        $this->assertInternalType('string', $actualPath, 'Method should return a string');
        $this->assertEquals($expectedPath, $actualPath, 'Method should return path to file');
    }
}