<?php

namespace app\modules\doctorworkbench\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\doctorworkbench\models\PccDiagnosis;

/**
 * PccDiagnosisSearch represents the model behind the search form of `app\modules\doctorworkbench\models\PccDiagnosis`.
 */
class PccDiagnosisSearch extends PccDiagnosis
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'hn', 'vn', 'provider_code', 'provider_name', 'date_service', 'time_service', 'icd_code', 'icd_name', 'diag_type', 'data_json', 'last_update'], 'safe'],
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
        $query = PccDiagnosis::find();

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
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['ilike', 'id', $this->id])
            ->andFilterWhere(['ilike', 'hn', $this->hn])
            ->andFilterWhere(['ilike', 'vn', $this->vn])
            ->andFilterWhere(['ilike', 'provider_code', $this->provider_code])
            ->andFilterWhere(['ilike', 'provider_name', $this->provider_name])
            ->andFilterWhere(['ilike', 'icd_code', $this->icd_code])
            ->andFilterWhere(['ilike', 'icd_name', $this->icd_name])
            ->andFilterWhere(['ilike', 'diag_type', $this->diag_type])
            ->andFilterWhere(['ilike', 'data_json', $this->data_json]);

        return $dataProvider;
    }
}
