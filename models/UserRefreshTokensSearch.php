<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserRefreshTokens;

/**
 * UserRefreshTokensSearch represents the model behind the search form of `app\models\UserRefreshTokens`.
 */
class UserRefreshTokensSearch extends UserRefreshTokens
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_refresh_tokenID', 'urf_userID'], 'integer'],
            [['urf_token', 'urf_ip', 'urf_user_agent', 'urf_created'], 'safe'],
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
        $query = UserRefreshTokens::find();

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
            'user_refresh_tokenID' => $this->user_refresh_tokenID,
            'urf_userID' => $this->urf_userID,
            'urf_created' => $this->urf_created,
        ]);

        $query->andFilterWhere(['like', 'urf_token', $this->urf_token])
            ->andFilterWhere(['like', 'urf_ip', $this->urf_ip])
            ->andFilterWhere(['like', 'urf_user_agent', $this->urf_user_agent]);

        return $dataProvider;
    }
}
