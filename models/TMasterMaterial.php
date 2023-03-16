<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_master_material".
 *
 * @property int $id
 * @property string $nama
 * @property string $deskripsi
 * @property int $id_satuan
 * @property int $flag
 *
 * @property TMasterSatuan $satuan
 * @property THargaMaterial[] $tHargaMaterials
 */
class TMasterMaterial extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE='create';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_master_material';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'deskripsi', 'id_satuan'], 'required'],
            [['deskripsi'], 'string'],
            [['id_satuan', 'flag'], 'integer'],
            [['nama'], 'string', 'max' => 100],
            [['id_satuan'], 'exist', 'skipOnError' => true, 'targetClass' => TMasterSatuan::class, 'targetAttribute' => ['id_satuan' => 'id']],
        ];
    }

    public function scenarios(){
        $scenario = parent::scenarios();
        $scenario ['create'] = ['nama' , 'deskripsi', 'id_satuan'];
        return $scenario;
    }

    /**
     * {@inheritdoc}
     */
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
