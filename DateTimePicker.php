<?php

namespace bloody_hell\yii2_xdan_datetimepicker;

use yii\helpers\Html;
use yii\helpers\Json;

class DateTimePicker extends \yii\widgets\InputWidget
{
    public $clientOptions = [];

    public $language;

    public function init()
    {
        parent::init();

        if(!$this->getId(false) && isset($this->options['id'])){
            $this->setId($this->options['id']);
        }

        $this->options['id'] = $this->getId();

        $this->clientOptions['lang'] = $this->language ? : \Yii::$app->language;
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