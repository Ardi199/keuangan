<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rekap;
use Yii;

/**
 * RekapSearch represents the model behind the search form of `app\models\Rekap`.
 */
class RekapSearch extends Rekap
{
    public $gaji;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['NOMINAL', 'KETERANGAN', 'CREATED_AT', 'UPDATED_AT', 'HARI', 'TANGGAL', 'gaji'], 'safe'],
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
        $query = Rekap::find();
        $query->orderBy(['TANGGAL' => SORT_DESC, 'NOMINAL' => SORT_DESC]);
        if (isset($this->gaji) and $this->gaji == '1') :
            $endOfNextMonth = date('Y-08-26');
            $startOfNextMonth = date('Y-07-26');
            $query->andWhere(['BETWEEN', 'TANGGAL', $startOfNextMonth, $endOfNextMonth]);
        endif;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'pagination' => array('pageSize' => 100),
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
            'UPDATED_AT' => $this->UPDATED_AT,
        ]);

        $query->andFilterWhere(['like', 'NOMINAL', $this->NOMINAL])
            ->andFilterWhere(['like', 'TANGGAL', $this->TANGGAL])
            ->andFilterWhere(['like', 'HARI', $this->HARI])
            ->andFilterWhere(['like', 'CREATED_AT', $this->CREATED_AT])
            ->andFilterWhere(['like', 'KETERANGAN', $this->KETERANGAN]);

        return $dataProvider;
    }
}
