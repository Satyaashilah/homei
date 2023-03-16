<?php

namespace app\services\base;

class Service
{
    /**
     * @var string the model class name. This property must be set.
     */
    public $model = null;

    /**
     * @var boolean set true if you want to use form name as model name
     */
    public $formname = true;

    public function __construct($formname = true)
    {
        $this->model;
        if ($formname) {
            $this->formname = (new $this->model)->formName();
        }
    }
}
