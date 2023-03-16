<?php

namespace app\models;

use Yii;
use \app\models\base\SupplierOrderCart as BaseSupplierOrderCart;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_supplier_order_cart".
 * Modified by Defri Indra M
 */
class SupplierOrderCart extends BaseSupplierOrderCart
{
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }
    
}
