<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DataPengguna;

/**
 * DataPenggunaSearch represents the model behind the search form of `app\models\DataPengguna`.
 */
class DataPenggunaSearch extends DataPengguna
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_PENGGUNA'], 'integer'],
            [['USERNAME', 'PASSWORD', 'STATUS_USER', 'JENIS_USER','NAMA_PENGGUNA'], 'safe'],
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
        $query = DataPengguna::find();

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
            'ID_PENGGUNA' => $this->ID_PENGGUNA,
        ]);

        $query->andFilterWhere(['like', 'USERNAME', $this->USERNAME])
            ->andFilterWhere(['like', 'PASSWORD', $this->PASSWORD])
            ->andFilterWhere(['like', 'NAMA_PENGGUNA', $this->NAMA_PENGGUNA])
            ->andFilterWhere(['like', 'STATUS_USER', $this->STATUS_USER])
            ->andFilterWhere(['like', 'JENIS_USER', $this->JENIS_USER]);

        return $dataProvider;
    }
}
