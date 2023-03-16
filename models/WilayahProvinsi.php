<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wilayah_provinsi".
 *
 * @property string $id
 * @property string $nama
 *
 * @property Portofolio[] $portofolios
 * @property THargaMaterial[] $tHargaMaterials
 * @property TIsianLanjutan[] $tIsianLanjutans
 * @property TSupplier[] $tSuppliers
 * @property WilayahKota[] $wilayahKotas
 */
class WilayahProvinsi extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE='create';  
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wilayah_provinsi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nama'], 'required'],
            [['id'], 'string', 'max' => 2],
            [['nama'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    public function scenarios(){
        $scenario = parent::scenarios();
        $scenario ['update'] = ['provinsi_id' , 'nama', 'id'];
        $scenario ['create'] = ['provinsi_id' , 'nama', 'id'];
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
        ];
    }

    /**
     * Gets query for [[Portofolios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortofolios()
    {
        return $this->hasMany(Portofolio::class, ['wilayah_provinsi' => 'id']);
    }

    /**
     * Gets query for [[THargaMaterials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTHargaMaterials()
    {
        return $this->hasMany(THargaMaterial::class, ['id_provinsi' => 'id']);
    }

    /**
     * Gets query for [[TIsianLanjutans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTIsianLanjutans()
    {
        return $this->hasMany(TIsianLanjutan::class, ['id_wilayah_provinsi' => 'id']);
    }

    /**
     * Gets query for [[TSuppliers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTSuppliers()
    {
        return $this->hasMany(TSupplier::class, ['id_provinsi' => 'id']);
    }

    /**
     * Gets query for [[WilayahKotas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWilayahKotas()
    {
        return $this->hasMany(WilayahKota::class, ['provinsi_id' => 'id']);
    }
}
