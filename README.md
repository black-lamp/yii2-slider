Slider module for Yii2
======================
Module for adding the image slider to site across dashboard and append it to view with widget help.
This extension uses [Slick slider](http://kenwheeler.github.io/slick/).

[![Build Status](https://travis-ci.org/black-lamp/yii2-slider.svg?branch=master)](https://travis-ci.org/black-lamp/yii2-slider)
[![Latest Stable Version](https://poser.pugx.org/black-lamp/yii2-slider/v/stable)](https://packagist.org/packages/black-lamp/yii2-slider)
[![Latest Unstable Version](https://poser.pugx.org/black-lamp/yii2-slider/v/unstable)](https://packagist.org/packages/black-lamp/yii2-slider)
[![License](https://poser.pugx.org/black-lamp/yii2-slider/license)](https://packagist.org/packages/black-lamp/yii2-slider)

Installation
------------
#### Run command
```
composer require black-lamp/yii2-slider
```
or add
```json
"black-lamp/yii2-slider": "*"
```
to the require section of your composer.json.
#### Applying migrations
```
yii migrate --migrationPath=@vendor/black-lamp/yii2-slider/src/common/migrations
```
#### Add module to application config
Module for backend
```php
'modules' => [
     // ...
     'slider' => [
         'class' => bl\slider\backend\Module::class
     ]
]
```
#### Module configuration properties

| Option | Description | Type | Default |
|---|---|---|---|
|imagesRoot|Path to images catalog in web folder (need for uploading images to the server across dashboard)|string|@frontend/web/img/slider|
|urlSeparator|Separator for getting url to image from image path|string|web|
|imagePrefix|Prefix for uploaded images (need for uploading images to the server across dashboard)|string|slider|

Using
-----
#### You should use the widget for adding the slider to the page
```php
<?= bl\slider\frontend\widgets\SliderWidget::widget([
        'sliderKey' => 'home-page-slider'
    ]) ?>
```
#### Widget configuration properties

| Option | Description | Type | Default |
|---|---|---|---|
|sliderKey|Unique slider key|string|-|
|imagePattern|Pattern for image|string|\<div style="background: url({url}) {params} no-repeat; background-size: cover; height: 400px;">\</div>|
|slickSliderOptions|Slider plugin configuration array.For more information read official [Slick slider](http://kenwheeler.github.io/slick/) documentation.|array|['slidesToShow' => '3', 'slidesToScroll' => '1', 'autoplay' => 'true', 'autoplaySpeed' =>  '2000']|

Also you can append this slider to your Active Record model
-----------------------------------------------------------
#### Configuration
Add behavior to your Active Record model
```php
use yii\db\ActiveRecord;

/**
 * @property string $sliderKey
 * @property SliderContent[] $sliderContent
 */
class Article extends ActiveRecord
{
    public function behaviors()
    {
        return [
            // ...
            'slider' => [
                'class' => \bl\slider\common\behaviors\SliderBehavior::class
            ],
        ];
    }
}
```
#### Using
```php
$article = new Article();
$article->sliderKey = "article-slider";

$slide_one = new SliderContent();
$slide_one->content = "img/slider/slider-1.jpg";
$slide_one->position = 1;

$slide_two = new SliderContent();
$slide_two->content = "img/slider/slider-2.jpg";
$slide_two->position = 2;

// slide N...

$article->sliderContent = $slide_one;
$article->sliderContent = $slide_two;
// or
$article->sliderContent = [$slide_one, $slide_two];

$article->save();
```
