<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace tests\unit\helpers;

use Yii;

use tests\unit\TestCase;

use bl\slider\common\helpers\Directory;
use yii\helpers\FileHelper;

/**
 * Test case for Directory helper
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class DirectoryTest extends TestCase
{
    private $basePath = '@tests/_output';
    private $path = 'test_dir';


    private function getPath($path)
    {
        return FileHelper::normalizePath($this->basePath . '/' . $path);
    }

    private function createDir()
    {
        if (!file_exists($this->path)) {
            mkdir($this->path);
        }
    }

    private function deleteDir()
    {
        if (file_exists($this->path)) {
            rmdir($this->path);
        }
    }

    public function _before()
    {
        $this->basePath = Yii::getAlias($this->basePath);
        $this->path = $this->getPath($this->path);
    }

    public function testIsExists()
    {
        $this->deleteDir();
        $this->assertFalse(Directory::isExists($this->path), 'Method must return false');

        $this->createDir();
        $this->assertTrue(Directory::isExists($this->path), 'Method must return true');
    }

    public function testCreate()
    {
        $path = $this->getPath('/create_test');
        Directory::create($path);

        $this->assertFileExists($path, 'Method must create a folder');
        $this->assertFalse(Directory::create($path), 'Method must return true because folder already exists');
    }

    public function testCreateRecursive()
    {
        $path = $this->getPath('/create/recursive/test');
        Directory::create($path, true);

        $this->assertFileExists($path, 'Method must create the 3 folders');
        $this->assertFalse(Directory::create($path), 'Method must return true because folder already exists');
    }

    public function testDelete()
    {
        $this->createDir();
        Directory::delete($this->path);

        $this->assertFileNotExists($this->path, 'Method must delete the directory');
        $this->assertFalse(Directory::delete($this->path), 'Method must return false because folder not exists');
    }

    public function testCreateForce()
    {
        $this->createDir();
        Directory::create($this->path, false, true);

        $this->assertFileExists($this->path, 'Method must create a folder');
    }
}