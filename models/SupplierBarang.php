<?php

namespace app\models;

use Yii;
use \app\models\base\SupplierBarang as BaseSupplierBarang;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_supplier_barang".
 * Modified by Defri Indra M
 */
class SupplierBarang extends BaseSupplierBarang
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
