<?php
namespace bl\slider\backend\controllers;

use yii;
use yii\helpers\Url;
use yii\web\Controller;

use bl\slider\common\entities\Slider;

/**
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class SliderController extends Controller
{
    public $defaultAction = "list";

    public function actionList()
    {
        $sliders = Slider::find()
            ->with('sliderContent')
            ->all();

        return $this->render('list', [
            'sliders' => $sliders
        ]);
    }

    public function actionCreate()
    {
        $slider = new Slider();

        if(Yii::$app->request->isPost) {
            $slider->load(Yii::$app->request->post());

            if($slider->validate() && $slider->save()) {
                return $this->redirect(
                    Url::toRoute('/slider')
                );
            }
        }

        return $this->render('create', [
            'slider' => $slider
        ]);
    }

    public function actionEdit($sliderId)
    {
        $slider = Slider::find()
            ->where(['id' => $sliderId])
            ->with(['sliderContent' => function($query) {
                /** @var yii\db\ActiveQuery $query */
                $query->orderBy(['position' => SORT_ASC]);
            }])
            ->one();

        if(Yii::$app->request->isPost) {
            $slider->load(Yii::$app->request->post());
            $slider->save(false);
        }

        return $this->render('edit/edit', [
            'slider' => $slider
        ]);
    }

    public function actionDelete($sliderId)
    {
        $slider = Slider::findOne($sliderId);
        $slider->delete();

        return $this->redirect(
            Yii::$app->request->referrer
        );
    }
}