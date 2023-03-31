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
    const SCENARIO_CREATE='create';
    const SCENARIO_UPDATE='update';
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
            [['nama_barang', 'deskripsi', 'gambar', 'panjang', 'lebar', 'tebal', 'stok', 'harga_ritel', 'harga_proyek', 'minimal_beli_satuan', 'minimal_beli_volume','supplier_id', 'material_id', 'submaterial_id'], 'required'],
            [['deskripsi', 'gambar'], 'string'],
            [['panjang', 'lebar', 'tebal', 'stok', 'harga_ritel', 'harga_proyek'], 'integer'],
            [['nama_barang'], 'string', 'max' => 100],
            // [['id_satuan'], 'exist', 'skipOnError' => true, 'targetClass' => TMasterSatuan::class, 'targetAttribute' => ['id_satuan' => 'id']],
        ];
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios ['create'] = ['nama_barang', 'deskripsi', 'gambar', 'panjang', 'lebar', 'tebal', 'stok', 'harga_ritel', 'harga_proyek'];
        $scenarios ['update'] = ['nama_barang', 'deskripsi', 'gambar', 'panjang', 'lebar', 'tebal', 'stok', 'harga_ritel', 'harga_proyek'];
        return $scenarios;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_barang' => 'Nama Barang',
            'deskripsi' => 'Deskripsi',
            'gambar' => 'Gambar',
            'panjang' => 'Panjang',
            'lebar' => 'Lebar',
            'tebal' => 'Tebal',
            'stok' => 'Stok',
            'harga_ritel' => 'Harga Ritel',
            'harga_proyek' => 'Harga Proyek',
        ];
    }

    
}
