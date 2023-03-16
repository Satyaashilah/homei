<?php

namespace app\models;

use Yii;
use \app\models\base\MasterMaterial as BaseMasterMaterial;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_master_material".
 * Modified by Defri Indra M
 */
class MasterMaterial extends BaseMasterMaterial
{
    const SCENARIO_CREATE='create';
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
        return [
            [['nama', 'deskripsi', 'id_satuan'], 'required'],
            [['deskripsi'], 'string'],
            [['id_satuan', 'flag'], 'integer'],
            [['nama'], 'string', 'max' => 100],
            [['id_satuan'], 'exist', 'skipOnError' => true, 'targetClass' => TMasterSatuan::class, 'targetAttribute' => ['id_satuan' => 'id']],
        ];
        // return ArrayHelper::merge(
        //     parent::rules(),
        //     [
        //         # custom validation rules
        //     ]
        // );
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios ['create'] = ['nama' , 'deskripsi', 'id_satuan'];
        return $scenarios;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'deskripsi' => 'Deskripsi',
            'id_satuan' => 'Id Satuan',
            'flag' => 'Flag',
        ];
    }

        /**
     * Gets query for [[Satuan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSatuan()
    {
        return $this->hasOne(TMasterSatuan::class, ['id' => 'id_satuan']);
    }

    /**
     * Gets query for [[THargaMaterials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTHargaMaterials()
    {
        return $this->hasMany(THargaMaterial::class, ['id_material' => 'id']);
    }
    
}
