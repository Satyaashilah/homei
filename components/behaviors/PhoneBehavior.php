<?php

namespace app\components\behaviors;

use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * PhoneBehavior
 * @author Defri Indra M
 * @property ActiveRecord $owner
 * @property string $column
 */
class PhoneBehavior extends AttributeBehavior
{
    public $column = "phone";
    public $prefix = "";
    const SEPARATOR = "-";

    public

    /**
     * Override event() 
     * memasukkan method beforeSave() kedalam komponen ActiveRecord::EVENT_BEFORE_INSERT  
     * @return type
     */
    function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => "beforeValidate",
        ];
    }

    private function formatted()
    {
        $phone = $this->owner->{$this->column};

        if ($phone == "") {
            return null;
        }

        $remove_white_space = str_replace(" ", "", $phone);
        $filter_phone = str_replace("-", "", $remove_white_space);

        if (substr($filter_phone, 0, 2) === "08") {
            $phone = substr($filter_phone, 1);
            $phone = "62" . $phone;
        } else if (substr($filter_phone, 0, 2) === "+") {
            $phone = substr($filter_phone, 1);
        }

        return $phone;
    }

    /**
     * set beforeValidate()
     */
    public function beforeValidate()
    {
        $this->owner->{$this->column} = $this->formatted();
    }
}
