<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace tests\unit\models\forms;

use tests\unit\TestCase;

use bl\slider\backend\models\forms\AddHtml;

/**
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class AddHtmlTest extends TestCase
{
    public function testSave()
    {
        $form = new AddHtml([
            'sliderId' => 1,
            'content' => "<h1>Test</h1>",
            'params' => 'test',
            'position' => 1,
        ]);

        $this->assertTrue($form->save(), 'Form must add data to database');
        $this->assertFalse($form->hasErrors(), 'Model should not have errors');
    }
}