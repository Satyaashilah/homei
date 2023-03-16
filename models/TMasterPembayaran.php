<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_master_pembayaran".
 *
 * @property int $id
 * @property string $nomor_rekening
 * @property string $nama_bank
 * @property string $atas_nama
 * @property string|null $keterangan
 * @property int $status
 */
class TMasterPembayaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_master_pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomor_rekening', 'nama_bank', 'atas_nama'], 'required'],
            [['keterangan'], 'string'],
            [['status'], 'integer'],
            [['nomor_rekening', 'nama_bank', 'atas_nama'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomor_rekening' => 'Nomor Rekening',
            'nama_bank' => 'Nama Bank',
            'atas_nama' => 'Atas Nama',
            'keterangan' => 'Keterangan',
            'status' => 'Status',
        ];
    }
}
