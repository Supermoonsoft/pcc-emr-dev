<?php

namespace app\modules\chiefcomplaint\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\chiefcomplaint\models\PccServicePe;

/**
 * PccServicePeSearch represents the model behind the search form of `app\modules\chiefcomplaint\models\PccServicePe`.
 */
class PccServicePeSearch extends PccServicePe
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pcc_vn', 'data_json', 'data1', 'data2', 'hospcode', 'pe_text', 'date_service', 'time_service', 'cid', 'vn', 'hn'], 'safe'],
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
        $query = PccServicePe::find();

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
            'date_service' => $this->date_service,
            'time_service' => $this->time_service,
        ]);

        $query->andFilterWhere(['ilike', 'id', $this->id])
            ->andFilterWhere(['ilike', 'pcc_vn', $this->pcc_vn])
            ->andFilterWhere(['ilike', 'data_json', $this->data_json])
            ->andFilterWhere(['ilike', 'data1', $this->data1])
            ->andFilterWhere(['ilike', 'data2', $this->data2])
            ->andFilterWhere(['ilike', 'hospcode', $this->hospcode])
            ->andFilterWhere(['ilike', 'pe_text', $this->pe_text])
            ->andFilterWhere(['ilike', 'cid', $this->cid])
            ->andFilterWhere(['ilike', 'vn', $this->vn])
            ->andFilterWhere(['ilike', 'hn', $this->hn]);

        return $dataProvider;
    }
}
