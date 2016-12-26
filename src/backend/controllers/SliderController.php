<?php
/**
 * @link https://github.com/black-lamp/yii2-slider
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\slider\backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

use bl\slider\common\entities\Slider;

/**
 * SliderController for SliderModule
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class SliderController extends Controller
{
    /**
     * @inheritdoc
     */
    public $defaultAction = "list";


    /**
     * Render list of sliders
     *
     * @return string
     */
    public function actionList()
    {
        $sliders = Slider::find()
            ->withSlides()
            ->all();

        return $this->render('list', [
            'sliders' => $sliders
        ]);
    }

    /**
     * Crate a slider
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $slider = new Slider();

        if(Yii::$app->request->isPost) {
            $slider->load(Yii::$app->request->post());

            if($slider->insert()) {
                return $this->redirect(Url::toRoute('/slider'));
            }
        }

        return $this->render('create', [
            'slider' => $slider
        ]);
    }

    /**
     * Edit the slider
     *
     * @param integer $sliderId
     * @return string
     */
    public function actionEdit($sliderId)
    {
        $slider = Slider::find()
            ->where(['id' => $sliderId])
            ->withSlides(['position' => SORT_ASC])
            ->one();

        if(Yii::$app->request->isPost) {
            $slider->load(Yii::$app->request->post());
            $slider->update(false);
        }

        return $this->render('edit/edit', [
            'slider' => $slider
        ]);
    }

    /**
     * Delete the slider
     *
     * @param integer $sliderId
     * @return \yii\web\Response
     */
    public function actionDelete($sliderId)
    {
        if ($slider = Slider::findOne($sliderId)) {
            $slider->delete();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}