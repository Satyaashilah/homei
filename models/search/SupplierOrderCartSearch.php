<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SupplierOrderCart;

/**
 * SupplierOrderCartSearch represents the model behind the search form about `app\models\SupplierOrderCart`.
 * Modified By Defri Indras
 */
class SupplierOrderCartSearch extends SupplierOrderCart{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id', 'user_id', 'material_id', 'submaterial_id', 'supplier_barang_id', 'supplier_id', 'volume', 'harga_satuan', 'subtotal', 'created_by', 'updated_by', 'deleted_by', 'flag', 'valid_spk'], 'integer'],
            [['kode_unik', 'created_at', 'updated_at', 'deleted_at', 'no_spk', 'keterangan_proyek'], 'safe'],
            [['jumlah'], 'number'],
        ];
    }

    /**
    * @inheritdoc
    */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
    * Creates data provider instance with search query applied
    *
    * @param array $params
    *
    * @return ActiveDataProvider
    */
    public function search($params)
    {
        $query = SupplierOrderCart::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'material_id' => $this->material_id,
            'submaterial_id' => $this->submaterial_id,
            'supplier_barang_id' => $this->supplier_barang_id,
            'supplier_id' => $this->supplier_id,
            'jumlah' => $this->jumlah,
            'volume' => $this->volume,
            'harga_satuan' => $this->harga_satuan,
            'subtotal' => $this->subtotal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'flag' => $this->flag,
            'valid_spk' => $this->valid_spk,
        ]);

        $query->andFilterWhere(['like', 'kode_unik', $this->kode_unik])
            ->andFilterWhere(['like', 'no_spk', $this->no_spk])
            ->andFilterWhere(['like', 'keterangan_proyek', $this->keterangan_proyek]);

        return $dataProvider;
    }
}