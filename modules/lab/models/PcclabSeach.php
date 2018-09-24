<?php

namespace app\modules\lab\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\lab\models\Pcclab;

/**
 * PcclabSeach represents the model behind the search form of `app\modules\lab\models\Pcclab`.
 */
class PcclabSeach extends Pcclab
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'hn', 'vn', 'provider_code', 'provider_name', 'date_service', 'time_service', 'lab_code', 'lab_name', 'standard_result', 'lab_request_at', 'lab_result_at', 'data_json', 'last_update', 'lab_result'], 'safe'],
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
        $query = Pcclab::find()->where(['hn' => '1190'])->OrderBy(['date_service'=>SORT_DESC,]);

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
            'lab_request_at' => $this->lab_request_at,
            'lab_result_at' => $this->lab_result_at,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['ilike', 'id', $this->id])
            ->andFilterWhere(['ilike', 'hn', $this->hn])
            ->andFilterWhere(['ilike', 'vn', $this->vn])
            ->andFilterWhere(['ilike', 'provider_code', $this->provider_code])
            ->andFilterWhere(['ilike', 'provider_name', $this->provider_name])
            ->andFilterWhere(['ilike', 'lab_code', $this->lab_code])
            ->andFilterWhere(['ilike', 'lab_name', $this->lab_name])
            ->andFilterWhere(['ilike', 'standard_result', $this->standard_result])
            ->andFilterWhere(['ilike', 'data_json', $this->data_json])
            ->andFilterWhere(['ilike', 'lab_result', $this->lab_result]);

        return $dataProvider;
    }
}
