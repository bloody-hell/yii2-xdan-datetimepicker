<?php

namespace bloody_hell\yii2_xdan_datetimepicker;

use yii\helpers\Html;

class DateTimePicker extends \yii\widgets\InputWidget
{
    public function run()
    {
        parent::run();

        DateTimePickerAsset::register($this->view);

        if($this->hasModel()){

            echo Html::activeTextInput($this->model, $this->attribute, $this->options);

        } else {
            echo Html::textInput($this->name, $this->value, $this->options);
        }
    }

} 