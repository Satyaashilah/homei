<?php

namespace app\models;

use Yii;
use \app\models\base\SupplierBarang as BaseSupplierBarang;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_supplier_barang".
 *
 * @property int $id
 * @property int $supplier_id
 * @property int|null $material_id
 * @property int $submaterial_id
 * @property string $nama_barang
 * @property string $slug
 * @property int $satuan_id
 * @property int|null $panjang
 * @property int|null $lebar
 * @property int|null $tebal
 * @property int $stok
 * @property int $harga_ritel
 * @property int $harga_proyek
 * @property int $minimal_beli_satuan minimal pembelian satuan untuk supplier proyek
 * @property int $minimal_beli_volume minimal pembelian volume untuk supplier proyek
 * @property string $deskripsi
 * @property string $gambar
 * @property string|null $params
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property int $status 0=nonaktif, 1= aktif
 * @property int $flag
 *
 * @property User $createdBy
 * @property User $deletedBy
 * @property TSupplierMaterial $material
 * @property TMasterSatuan $satuan
 * @property TSupplierSubmaterial $submaterial
 * @property TSupplier $supplier
 * @property TBarangMasuk[] $tBarangMasuks
 * @property TDetailContohProduk[] $tDetailContohProduks
 * @property TSupplierOrderCart[] $tSupplierOrderCarts
 * @property TSupplierOrderDetail[] $tSupplierOrderDetails
 * @property User $updatedBy
 */
class SupplierBarang extends BaseSupplierBarang
{
    const SCENARIO_CREATE='create';
    const SCENARIO_UPDATE='update';
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_supplier_barang';
    }
    public function rules()
    {
        return [
            [['supplier_id', 'submaterial_id', 'nama_barang', 'slug', 'satuan_id', 'stok', 'harga_ritel', 'harga_proyek', 'minimal_beli_satuan', 'minimal_beli_volume', 'deskripsi', 'gambar'], 'required'],
            [['supplier_id', 'material_id', 'submaterial_id', 'satuan_id', 'panjang', 'lebar', 'tebal', 'stok', 'harga_ritel', 'harga_proyek', 'minimal_beli_satuan', 'minimal_beli_volume', 'created_by', 'updated_by', 'deleted_by', 'status', 'flag'], 'integer'],
            [['deskripsi', 'gambar', 'params'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['nama_barang', 'slug'], 'string', 'max' => 255],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => TSupplier::class, 'targetAttribute' => ['supplier_id' => 'id']],
            [['satuan_id'], 'exist', 'skipOnError' => true, 'targetClass' => TMasterSatuan::class, 'targetAttribute' => ['satuan_id' => 'id']],
            [['submaterial_id'], 'exist', 'skipOnError' => true, 'targetClass' => TSupplierSubmaterial::class, 'targetAttribute' => ['submaterial_id' => 'id']],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => TSupplierMaterial::class, 'targetAttribute' => ['material_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['deleted_by' => 'id']],
        ];
    }
    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios ['create'] = ['nama_barang', 'deskripsi', 'gambar', 'panjang', 'lebar', 'tebal', 'stok', 'harga_ritel', 'harga_proyek'];
        $scenarios ['update'] = ['nama_barang', 'deskripsi', 'gambar', 'panjang', 'lebar', 'tebal', 'stok', 'harga_ritel', 'harga_proyek'];
        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'supplier_id' => 'Supplier ID',
            'material_id' => 'Material ID',
            'submaterial_id' => 'Submaterial ID',
            'nama_barang' => 'Nama Barang',
            'slug' => 'Slug',
            'satuan_id' => 'Satuan ID',
            'panjang' => 'Panjang',
            'lebar' => 'Lebar',
            'tebal' => 'Tebal',
            'stok' => 'Stok',
            'harga_ritel' => 'Harga Ritel',
            'harga_proyek' => 'Harga Proyek',
            'minimal_beli_satuan' => 'Minimal Beli Satuan',
            'minimal_beli_volume' => 'Minimal Beli Volume',
            'deskripsi' => 'Deskripsi',
            'gambar' => 'Gambar',
            'params' => 'Params',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'deleted_by' => 'Deleted By',
            'status' => 'Status',
            'flag' => 'Flag',
        ];
    }
    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[DeletedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeletedBy()
    {
        return $this->hasOne(User::class, ['id' => 'deleted_by']);
    }

    /**
     * Gets query for [[Material]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(TSupplierMaterial::class, ['id' => 'material_id']);
    }

    /**
     * Gets query for [[Satuan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSatuan()
    {
        return $this->hasOne(TMasterSatuan::class, ['id' => 'satuan_id']);
    }

    /**
     * Gets query for [[Submaterial]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubmaterial()
    {
        return $this->hasOne(TSupplierSubmaterial::class, ['id' => 'submaterial_id']);
    }

    /**
     * Gets query for [[Supplier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(TSupplier::class, ['id' => 'supplier_id']);
    }

    /**
     * Gets query for [[TBarangMasuks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTBarangMasuks()
    {
        return $this->hasMany(TBarangMasuk::class, ['id_supplier_barang' => 'id']);
    }

    /**
     * Gets query for [[TDetailContohProduks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTDetailContohProduks()
    {
        return $this->hasMany(TDetailContohProduk::class, ['id_supplier_barang' => 'id']);
    }

    /**
     * Gets query for [[TSupplierOrderCarts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTSupplierOrderCarts()
    {
        return $this->hasMany(TSupplierOrderCart::class, ['supplier_barang_id' => 'id']);
    }

    /**
     * Gets query for [[TSupplierOrderDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTSupplierOrderDetails()
    {
        return $this->hasMany(TSupplierOrderDetail::class, ['supplier_barang_id' => 'id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}
