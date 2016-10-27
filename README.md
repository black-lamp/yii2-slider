Slider module for Yii2
======================
Module for adding sliders to site across dashboard.
This extension uses [Slick slider](http://kenwheeler.github.io/slick/).

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
`yii migrate --migrationPath=@vendor/black-lamp/yii2-slider/migrations`
```
#### Add module to application config
```php
'modules' => [
     // ...
     'slider' => [
         'class' => bl\slider\backend\SliderModule::className()
     ]
]
```
#### Module configuration properties

|Option|Type|Default|Description|
|---|---|---|---|
|imagesDir|string|img/slider|Path to images catalog in web folder (need for uploading images to the server across dashboard)|
|imagePrefix|string|slider|Prefix for uploaded images (need for uploading images to the server across dashboard)|

Using
------------
#### You should use the widget for adding the slider to the page
```php
<?= bl\slider\frontend\widgets\SliderWidget::widget([
        'sliderKey' => 'home-page-slider'
    ]) ?>
```
#### Widget configuration properties

|Option|Type|Default|Description|
|---|---|---|---|
|sliderKey|string|-|Unique slider key|
|imageHeight|string|400px|CSS property for block with image|
|imageCrop|boolean|false|If set `true` to block with image will be appended CSS property `background-size: cover`. If set `false` - `background-size: contain`|
|slickSliderOptions|array|['slidesToShow' => '3', 'slidesToScroll' => '1', 'autoplay' => 'true', 'autoplaySpeed' =>  '2000']|Slider plugin configuration array.For more information read official [Slick slider](http://kenwheeler.github.io/slick/) documentation.|