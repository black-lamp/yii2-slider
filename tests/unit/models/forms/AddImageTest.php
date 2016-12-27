<?php
namespace tests\unit\models\forms;

use tests\unit\TestCase;

use Yii;

use bl\slider\backend\models\forms\AddImage;

/**
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class AddImageTest extends TestCase
{
    public function _before()
    {
        Yii::$container->set('bl\slider\backend\models\UploadImage', [], [
            Yii::getAlias('@tests/_output'),
            'test'
        ]);
        Yii::$container->set('UploadImage', 'bl\slider\backend\models\UploadImage');

        Yii::$container->set('bl\slider\backend\models\forms\AddImage', [], [
            Yii::$container->get('UploadImage')
        ]);
        Yii::$container->set('AddImage', 'bl\slider\backend\models\forms\AddImage');
    }

    public function testSavePath()
    {
        /** @var AddImage $form */
        $form = Yii::$container->get('AddImage');

        $form->sliderId = 1;
        $form->content = "_data/test_image.png";
        $form->params = 'test';
        $form->position = 1;
        $form->alt = 'test';

        $this->assertTrue($form->save(), 'Form must add data to database');
        $this->assertFalse($form->hasErrors(), 'Model should not have errors');
    }
}