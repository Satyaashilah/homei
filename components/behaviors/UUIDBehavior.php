<?php

namespace app\components\behaviors;

use Faker\Provider\Uuid;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * UUID Behavior will set your ID with UUID
 * @author Defri Indra M
 **/

class UUIDBehavior extends AttributeBehavior
{
    public $primaryKey = "id";
    public $model = null;
    public $prefix = "";
    const SEPARATOR = "-";

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => "beforeInsert",
        ];
    }

    private function validUuid()
    {
        $uuid = $this->generateUuid();
        if ($this->model != null) {
            $exist = $this->model::find()->where([$this->primaryKey => $uuid])->exists();
            while ($exist == true) {
                $uuid = $this->generateUuid();
                $exist = $this->model::find()->where([$this->primaryKey => $uuid])->exists();
            }
        }

        return $uuid;
    }

    private function generateUuid()
    {
        $uuid = Uuid::uuid();

        if ($this->prefix) {
            $uuid = $this->prefix . static::SEPARATOR . $uuid;
        }

        return $uuid;
    }

    /**
     * set beforeInsert() -> UUID data
     */
    public function beforeInsert()
    {
        $this->owner->{$this->primaryKey} = $this->validUuid();
    }
}
