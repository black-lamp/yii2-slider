<?php
namespace bl\slider\backend\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

use bl\slider\backend\SliderModule;
use bl\slider\backend\models\UploadImage;
use bl\slider\common\entities\SliderContent;

/**
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class ContentController extends Controller
{
    public function actionAddImage($sliderId)
    {
        $slider_content = new SliderContent();
        $upload_image = new UploadImage();

        $viewParams = [
            'slider_content' => $slider_content,
            'upload_image' => $upload_image,
            'slider_id' => $sliderId
        ];

        if(Yii::$app->request->isPost) {
            $slider_content->load(Yii::$app->request->post());

            if($upload_image->imageFile = UploadedFile::getInstance($upload_image, 'imageFile')) {
                /** @var SliderModule $module */
                $module = $this->module;

                $slider_content->content = $upload_image->upload(
                    $module->imagesRoot,
                    $module->imagePrefix
                );
            }

            if($slider_content->validate() && $slider_content->save()) {
                return $this->redirect(
                    Yii::$app->request->referrer
                );
            }
            else {
                $viewParams['errors'] = $slider_content->errors;
            }
        }

        return $this->render('add_image', $viewParams);
    }

    public function actionAddHtml($sliderId)
    {
        $slider_content = new SliderContent();

        $viewParams = [
            'slider_content' => $slider_content,
            'slider_id' => $sliderId
        ];

        if(Yii::$app->request->isPost) {
            $slider_content->load(Yii::$app->request->post());
            $slider_content->is_image = 0;

            if($slider_content->validate() && $slider_content->save()) {
                return $this->redirect(
                    Yii::$app->request->referrer
                );
            }
            else {
                $viewParams['errors'] = $slider_content->errors;
            }
        }

        return $this->render('add_html', $viewParams);
    }

    public function actionEdit($id)
    {
        if(Yii::$app->request->isPost) {
            $sliderContent = SliderContent::findOne($id);
            $sliderContent->load(Yii::$app->request->post());

            if($sliderContent->validate() && $sliderContent->save()) {
                return $this->redirect(
                    Yii::$app->request->referrer
                );
            }
        }

        throw new NotFoundHttpException("Page not found!");
    }

    public function actionDelete($id)
    {
        $sliderContent = SliderContent::findOne($id);
        $sliderContent->delete();

        return $this->redirect(
            Yii::$app->request->referrer
        );
    }
}