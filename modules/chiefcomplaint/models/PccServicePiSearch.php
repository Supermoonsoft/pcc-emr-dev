<?php

namespace app\modules\chiefcomplaint\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\chiefcomplaint\models\PccServicePi;

/**
 * PccServicePiSearch represents the model behind the search form of `app\modules\chiefcomplaint\models\PccServicePi`.
 */
class PccServicePiSearch extends PccServicePi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pcc_vn', 'data_json', 'date_service', 'time_service', 'data1', 'data2', 'hospcode', 'pi_text', 'cid', 'vn', 'hn'], 'safe'],
            [['sbp', 'dbp', 'temp', 'pp', 'pr', 'o2sat', 'height', 'weight'], 'number'],
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
        $query = PccServicePi::find();

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
            'sbp' => $this->sbp,
            'dbp' => $this->dbp,
            'temp' => $this->temp,
            'pp' => $this->pp,
            'pr' => $this->pr,
            'o2sat' => $this->o2sat,
            'height' => $this->height,
            'weight' => $this->weight,
        ]);

        $query->andFilterWhere(['ilike', 'id', $this->id])
            ->andFilterWhere(['ilike', 'pcc_vn', $this->pcc_vn])
            ->andFilterWhere(['ilike', 'data_json', $this->data_json])
            ->andFilterWhere(['ilike', 'data1', $this->data1])
            ->andFilterWhere(['ilike', 'data2', $this->data2])
            ->andFilterWhere(['ilike', 'hospcode', $this->hospcode])
            ->andFilterWhere(['ilike', 'pi_text', $this->pi_text])
            ->andFilterWhere(['ilike', 'cid', $this->cid])
            ->andFilterWhere(['ilike', 'vn', $this->vn])
            ->andFilterWhere(['ilike', 'hn', $this->hn]);

        return $dataProvider;
    }
}
