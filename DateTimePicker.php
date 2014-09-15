<?php

namespace bloody_hell\yii2_xdan_datetimepicker;

use yii\helpers\Html;
use yii\helpers\Json;

class DateTimePicker extends \yii\widgets\InputWidget
{
    public $clientOptions = [];

    public $language;

    public $formatDate = 'Y/m/d';

    public $format = 'Y/m/d H:i';

    public $step = 60;

    public $yearStart = 1950;

    public $yearEnd = 2050;

    public $dayOfWeekStart = 0;

    public function init()
    {
        parent::init();

        if(!$this->getId(false) && isset($this->options['id'])){
            $this->setId($this->options['id']);
        }

        $this->options['id'] = $this->getId();

        $this->clientOptions = array_merge([
            'lang'            => $this->language ? : \Yii::$app->language,
            'format'          => $this->format,
            'formatDate'      => $this->formatDate,
            'step'            => $this->step,
            'yearStart'       => $this->yearStart,
            'yearEnd'         => $this->yearEnd,
            'dayOfWeekStart'  => $this->dayOfWeekStart,
        ], $this->clientOptions);
    }


    public function run()
    {
        parent::run();

        DateTimePickerAsset::register($this->view);

        if($this->hasModel()){
            echo Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textInput($this->name, $this->value, $this->options);
        }

        $this->view->registerJs('jQuery(\'#'.$this->getId().'\').datetimepicker('.Json::encode($this->getClientOptions()).');');
    }


    protected function getClientOptions()
    {
        return $this->clientOptions;
    }
} 