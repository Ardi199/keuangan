<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pemasukan;

/**
 * PemasukanSearch represents the model behind the search form of `app\models\Pemasukan`.
 */
class PemasukanSearch extends Pemasukan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['NOMINAL'], 'number'],
            [['KETERANGAN', 'CREATED_AT', 'UPDATED_AT','TANGGAL','BULAN'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Pemasukan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            'NOMINAL' => $this->NOMINAL,
            'UPDATED_AT' => $this->UPDATED_AT,
        ]);

        $query->andFilterWhere(['like', 'KETERANGAN', $this->KETERANGAN])
        ->andFilterWhere(['like', 'BULAN', $this->BULAN])
        ->andFilterWhere(['like', 'TANGGAL', $this->TANGGAL])
        ->andFilterWhere(['like', 'CREATED_AT', $this->CREATED_AT]);

        return $dataProvider;
    }
}
