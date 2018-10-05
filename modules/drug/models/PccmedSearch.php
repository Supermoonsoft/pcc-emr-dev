<?php

namespace app\modules\drug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\drug\models\Pccmed;

/**
 * PccmedSeach represents the model behind the search form of `app\modules\drug\models\Pccmed`.
 */
class PccmedSearch extends Pccmed
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'hospcode', 'hospname', 'hn', 'vn', 'an', 'date_visit', 'time_visit', 'drug_name', 'qty', 'unit', 'usage_line1', 'usage_line2', 'usage_line3', 'icode', 'tmt24_code', 'data_json', 'last_update', 'cid', 'provider'], 'safe'],
            [['unitprice', 'costprice'], 'number'],
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
        $query = Pccmed::find();

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
            'date_visit' => $this->date_visit,
            'time_visit' => $this->time_visit,
            'unitprice' => $this->unitprice,
            'last_update' => $this->last_update,
            'costprice' => $this->costprice,
        ]);

        $query->andFilterWhere(['ilike', 'id', $this->id])
            ->andFilterWhere(['ilike', 'hospcode', $this->hospcode])
            ->andFilterWhere(['ilike', 'hospname', $this->hospname])
            ->andFilterWhere(['ilike', 'hn', $this->hn])
            ->andFilterWhere(['ilike', 'vn', $this->vn])
            ->andFilterWhere(['ilike', 'an', $this->an])
            ->andFilterWhere(['ilike', 'drug_name', $this->drug_name])
            ->andFilterWhere(['ilike', 'qty', $this->qty])
            ->andFilterWhere(['ilike', 'unit', $this->unit])
            ->andFilterWhere(['ilike', 'usage_line1', $this->usage_line1])
            ->andFilterWhere(['ilike', 'usage_line2', $this->usage_line2])
            ->andFilterWhere(['ilike', 'usage_line3', $this->usage_line3])
            ->andFilterWhere(['ilike', 'icode', $this->icode])
            ->andFilterWhere(['ilike', 'tmt24_code', $this->tmt24_code])
            ->andFilterWhere(['ilike', 'data_json', $this->data_json])
            ->andFilterWhere(['ilike', 'cid', $this->cid])
            ->andFilterWhere(['ilike', 'provider', $this->provider]);

        return $dataProvider;
    }
}
