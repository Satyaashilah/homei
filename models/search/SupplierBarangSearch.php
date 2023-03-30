<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SupplierBarang;

/**
 * SupplierBarangSearch represents the model behind the search form about `app\models\SupplierBarang`.
 * Modified By Defri Indras
 */
class SupplierBarangSearch extends SupplierBarang{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id', 'supplier_id', 'material_id', 'submaterial_id', 'satuan_id', 'panjang', 'lebar', 'tebal', 'stok', 'harga_ritel', 'harga_proyek', 'minimal_beli_satuan', 'minimal_beli_volume', 'created_by', 'updated_by', 'deleted_by', 'status', 'flag'], 'integer'],
            [['nama_barang', 'slug', 'deskripsi', 'gambar', 'params', 'created_at', 'updated_at'], 'safe'],
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
        $query = SupplierBarang::find();

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
            'supplier_id' => $this->supplier_id,
            'material_id' => $this->material_id,
            'submaterial_id' => $this->submaterial_id,
            'satuan_id' => $this->satuan_id,
            'panjang' => $this->panjang,
            'lebar' => $this->lebar,
            'tebal' => $this->tebal,
            'stok' => $this->stok,
            'harga_ritel' => $this->harga_ritel,
            'harga_proyek' => $this->harga_proyek,
            'minimal_beli_satuan' => $this->minimal_beli_satuan,
            'minimal_beli_volume' => $this->minimal_beli_volume,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'status' => $this->status,
            'flag' => $this->flag,
        ]);

        $query->andFilterWhere(['like', 'nama_barang', $this->nama_barang])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'deskripsi', $this->deskripsi])
            ->andFilterWhere(['like', 'gambar', $this->gambar])
            ->andFilterWhere(['like', 'params', $this->params]);

        return $dataProvider;
    }
}