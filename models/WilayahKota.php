<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wilayah_kota".
 *
 * @property string $id
 * @property string $provinsi_id
 * @property string $nama
 *
 * @property WilayahProvinsi $provinsi
 * @property THargaMaterial[] $tHargaMaterials
 * @property TIsianLanjutan[] $tIsianLanjutans
 * @property TSupplier[] $tSuppliers
 * @property WilayahKecamatan[] $wilayahKecamatans
 */
class WilayahKota extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE='create';    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wilayah_kota';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'provinsi_id', 'nama'], 'required'],
            [['id'], 'string', 'max' => 4],
            [['provinsi_id'], 'string', 'max' => 2],
            [['nama'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['provinsi_id'], 'exist', 'skipOnError' => true, 'targetClass' => WilayahProvinsi::class, 'targetAttribute' => ['provinsi_id' => 'id']],
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
            'provinsi_id' => 'Provinsi ID',
            'nama' => 'Nama',
        ];
    }

    /**
     * Gets query for [[Provinsi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvinsi()
    {
        return $this->hasOne(WilayahProvinsi::class, ['id' => 'provinsi_id']);
    }

    /**
     * Gets query for [[THargaMaterials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTHargaMaterials()
    {
        return $this->hasMany(THargaMaterial::class, ['id_kota' => 'id']);
    }

    /**
     * Gets query for [[TIsianLanjutans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTIsianLanjutans()
    {
        return $this->hasMany(TIsianLanjutan::class, ['id_wilayah_kota' => 'id']);
    }

    /**
     * Gets query for [[TSuppliers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTSuppliers()
    {
        return $this->hasMany(TSupplier::class, ['id_kota' => 'id']);
    }

    /**
     * Gets query for [[WilayahKecamatans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWilayahKecamatans()
    {
        return $this->hasMany(WilayahKecamatan::class, ['kota_id' => 'id']);
    }
}
