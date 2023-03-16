<?php

namespace app\models;

use Yii;
use \app\models\base\SupplierOrderCart as BaseSupplierOrderCart;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_supplier_order_cart".
 *
 * @property int $id
 * @property string $kode_unik
 * @property int $user_id
 * @property int|null $material_id
 * @property int|null $submaterial_id
 * @property int $supplier_barang_id
 * @property int|null $supplier_id
 * @property float|null $jumlah jumlah
 * @property int|null $volume volume meter kubik
 * @property int|null $harga_satuan
 * @property int|null $subtotal
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property int $flag 0=hapus, 1=aktif
 * @property string|null $no_spk
 * @property string|null $keterangan_proyek
 * @property int $valid_spk
 *
 * @property User $createdBy
 * @property User $deletedBy
 * @property SupplierMaterial $material
 * @property SupplierSubmaterial $submaterial
 * @property Supplier $supplier
 * @property SupplierBarang $supplierBarang
 * @property User $updatedBy
 * @property User $user
 */
class TSupplierOrderCart extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE='create';
    const SCENARIO_UPDATE='update';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_supplier_order_cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_unik', 'user_id', 'supplier_barang_id'], 'required'],
            [['user_id', 'material_id', 'submaterial_id', 'supplier_barang_id', 'supplier_id', 'volume', 'harga_satuan', 'subtotal', 'created_by', 'updated_by', 'deleted_by', 'flag', 'valid_spk'], 'integer'],
            [['jumlah'], 'number'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['keterangan_proyek'], 'string'],
            [['kode_unik'], 'string', 'max' => 50],
            [['no_spk'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['supplier_barang_id'], 'exist', 'skipOnError' => true, 'targetClass' => SupplierBarang::class, 'targetAttribute' => ['supplier_barang_id' => 'id']],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => SupplierMaterial::class, 'targetAttribute' => ['material_id' => 'id']],
            [['submaterial_id'], 'exist', 'skipOnError' => true, 'targetClass' => SupplierSubmaterial::class, 'targetAttribute' => ['submaterial_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['deleted_by' => 'id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::class, 'targetAttribute' => ['supplier_id' => 'id']],
        ];
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios ['create'] = ['user_id', 'jumlah', 'material_id'];
        $scenarios ['update'] = ['user_id', 'jumlah', 'material_id'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_unik' => 'Kode Unik',
            'user_id' => 'User ID',
            'material_id' => 'Material ID',
            'submaterial_id' => 'Submaterial ID',
            'supplier_barang_id' => 'Supplier Barang ID',
            'supplier_id' => 'Supplier ID',
            'jumlah' => 'Jumlah',
            'volume' => 'Volume',
            'harga_satuan' => 'Harga Satuan',
            'subtotal' => 'Subtotal',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'deleted_by' => 'Deleted By',
            'flag' => 'Flag',
            'no_spk' => 'No Spk',
            'keterangan_proyek' => 'Keterangan Proyek',
            'valid_spk' => 'Valid Spk',
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
        return $this->hasOne(SupplierMaterial::class, ['id' => 'material_id']);
    }

    /**
     * Gets query for [[Submaterial]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubmaterial()
    {
        return $this->hasOne(SupplierSubmaterial::class, ['id' => 'submaterial_id']);
    }

    /**
     * Gets query for [[Supplier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::class, ['id' => 'supplier_id']);
    }

    /**
     * Gets query for [[SupplierBarang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupplierBarang()
    {
        return $this->hasOne(SupplierBarang::class, ['id' => 'supplier_barang_id']);
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
