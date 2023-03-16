<?php

namespace app\modules\blog\behaviors;


class PostSummaryBehavior extends \yii\base\Behavior
{
    public $defaultLength = 100;
    public $length = null;
    public $attribute = "summary";
    public $sourceAttribute = "content";

    public function events()
    {
        return [
            \yii\db\ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
        ];
    }

    public function beforeValidate()
    {
        $this->owner->{$this->attribute} = $this->summaryBuilder($this->owner->{$this->sourceAttribute}, $this->length);
    }

    public function summaryBuilder($content, $length = null)
    {
        // clean up the content from html tags
        $content = strip_tags($content);

        if ($length === null) {
            $length = $this->summaryLength;
        }
        if (strlen($content) <= $length) {
            return $content;
        }
        $lastSpace = strrpos(substr($content, 0, $length), ' ');
        return substr($content, 0, $lastSpace) . '...';
    }
}
