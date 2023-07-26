<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Hutang;

/**
 * HutangSearch represents the model behind the search form of `app\models\Hutang`.
 */
class HutangSearch extends Hutang
{
    public $isApprove;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['KETERANGAN', 'BUKTI', 'CREATED_AT', 'UPDATED_AT', 'STATUS','isApprove'], 'safe'],
            [['NOMINAL'], 'number'],
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
        $query = Hutang::find();
        $query->orderBy(['CREATED_AT' => SORT_DESC]);
        if($this->isApprove == '1'):
            $query->andWhere(['STATUS' => 'Belum di Bayar']);
        endif;

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
        ]);

        $query->andFilterWhere(['like', 'KETERANGAN', $this->KETERANGAN])
            ->andFilterWhere(['like', 'STATUS', $this->STATUS])
            ->andFilterWhere(['like', 'CREATED_AT', $this->CREATED_AT])
            ->andFilterWhere(['like', 'UPDATED_AT', $this->UPDATED_AT])
            ->andFilterWhere(['like', 'BUKTI', $this->BUKTI]);

        return $dataProvider;
    }
}
