<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\slider\backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use bl\slider\backend\SliderModule;
use bl\slider\common\entities\SliderContent;
use bl\slider\backend\models\forms\AddHtml;
use bl\slider\backend\models\forms\AddImage;
use bl\slider\backend\models\forms\BaseContentForm;

/**
 * ContentController for SliderModule
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class ContentController extends Controller
{
    /**
     * @var SliderModule
     */
    public $module;


    /**
     * Render form for adding slider content
     *
     * @param AddHtml|AddImage $form
     * @param string $view
     * @param array $params
     * @return \yii\web\Response|string
     */
    public function renderForm($form, $view, $params = [])
    {
        if (Yii::$app->request->isPost) {
            $form->load(Yii::$app->request->post());
            if ($form->save()) {
                return $this->redirect(Yii::$app->request->referrer);
            }

            $params['errors'] = $form->getErrors();
        }

        return $this->render($view, $params);
    }

    /**
     * Add image to slider
     *
     * @param integer $sliderId
     * @return string|\yii\web\Response
     */
    public function actionAddImage($sliderId)
    {
        /** @var AddImage $addImageForm */
        $addImageForm = Yii::$container->get('AddImageModel');
        $addImageForm->sliderId = $sliderId;

        return $this->renderForm($addImageForm, 'add_image', [
            'addImageForm' => $addImageForm,
            'uploadImage' => Yii::$container->get('UploadImageModel')
        ]);
    }

    /**
     * Add HTML content to slider
     *
     * @param integer $sliderId
     * @return string|\yii\web\Response
     */
    public function actionAddHtml($sliderId)
    {
        $form = new AddHtml();
        $form->sliderId = $sliderId;

        return $this->renderForm($form, 'add_html', [
            'model' => $form
        ]);
    }

    /**
     *  Edit the slider content
     *
     * @param integer $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionEdit($id)
    {
        if(Yii::$app->request->isPost) {
            if ($sliderContent = SliderContent::findOne($id)) {
                $sliderContent->load(Yii::$app->request->post());
                $sliderContent->update();
            }

            return $this->redirect(Yii::$app->request->referrer);
        }

        throw new NotFoundHttpException("Page not found!");
    }

    /**
     * Delete the slider content
     *
     * @param integer $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        if ($sliderContent = SliderContent::findOne($id)) {
            $sliderContent->delete();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}