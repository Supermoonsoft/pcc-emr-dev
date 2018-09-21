<?php

namespace app\modules\lab\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\lab\models\Preorderlab;

/**
 * PreorderlabSeach represents the model behind the search form of `app\modules\lab\models\Preorderlab`.
 */
class PreorderlabSeach extends Preorderlab
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cid', 'hos_hn', 'hos_vn', 'hos_date_visit', 'lab_code_hos', 'lab_code_moph', 'lab_name_hos', 'request_at', 'result_at', 'data_json', 'lab_name_moph', 'hos_result', 'lab_normal', 'lab_possible', 'lab_range_min', 'lab_range_max', 'lab_range_female_min', 'lab_range_female_max'], 'safe'],
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
        $query = Preorderlab::find();

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
            'hos_date_visit' => $this->hos_date_visit,
            'request_at' => $this->request_at,
            'result_at' => $this->result_at,
        ]);

        $query->andFilterWhere(['ilike', 'id', $this->id])
            ->andFilterWhere(['ilike', 'cid', $this->cid])
            ->andFilterWhere(['ilike', 'hos_hn', $this->hos_hn])
            ->andFilterWhere(['ilike', 'hos_vn', $this->hos_vn])
            ->andFilterWhere(['ilike', 'lab_code_hos', $this->lab_code_hos])
            ->andFilterWhere(['ilike', 'lab_code_moph', $this->lab_code_moph])
            ->andFilterWhere(['ilike', 'lab_name_hos', $this->lab_name_hos])
            ->andFilterWhere(['ilike', 'data_json', $this->data_json])
            ->andFilterWhere(['ilike', 'lab_name_moph', $this->lab_name_moph])
            ->andFilterWhere(['ilike', 'hos_result', $this->hos_result])
            ->andFilterWhere(['ilike', 'lab_normal', $this->lab_normal])
            ->andFilterWhere(['ilike', 'lab_possible', $this->lab_possible])
            ->andFilterWhere(['ilike', 'lab_range_min', $this->lab_range_min])
            ->andFilterWhere(['ilike', 'lab_range_max', $this->lab_range_max])
            ->andFilterWhere(['ilike', 'lab_range_female_min', $this->lab_range_female_min])
            ->andFilterWhere(['ilike', 'lab_range_female_max', $this->lab_range_female_max]);

        return $dataProvider;
    }
}
