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
            [['id', 'pcc_vn', 'data_json', 'pcc_start_service_datetime', 'pcc_end_service_datetime', 'data1', 'data2', 'hoscode', 'lab_code', 'lab_name', 'lab_standard_result', 'lab_request_at', 'lab_result_at', 'lab_result', 'lab_code_moph'], 'safe'],
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
            'pcc_start_service_datetime' => $this->pcc_start_service_datetime,
            'pcc_end_service_datetime' => $this->pcc_end_service_datetime,
        ]);

        $query->andFilterWhere(['ilike', 'id', $this->id])
            ->andFilterWhere(['ilike', 'pcc_vn', $this->pcc_vn])
            ->andFilterWhere(['ilike', 'data_json', $this->data_json])
            ->andFilterWhere(['ilike', 'data1', $this->data1])
            ->andFilterWhere(['ilike', 'data2', $this->data2])
            ->andFilterWhere(['ilike', 'hoscode', $this->hoscode])
            ->andFilterWhere(['ilike', 'lab_code', $this->lab_code])
            ->andFilterWhere(['ilike', 'lab_name', $this->lab_name])
            ->andFilterWhere(['ilike', 'lab_standard_result', $this->lab_standard_result])
            ->andFilterWhere(['ilike', 'lab_request_at', $this->lab_request_at])
            ->andFilterWhere(['ilike', 'lab_result_at', $this->lab_result_at])
            ->andFilterWhere(['ilike', 'lab_result', $this->lab_result])
            ->andFilterWhere(['ilike', 'lab_code_moph', $this->lab_code_moph]);

        return $dataProvider;
    }
}
