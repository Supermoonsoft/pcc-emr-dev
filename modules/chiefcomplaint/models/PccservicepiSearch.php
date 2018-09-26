<?php

namespace app\modules\chiefcomplaint\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\chiefcomplaint\models\Pccservicepi;

/**
 * PccservicepiSearch represents the model behind the search form about `app\modules\chiefcomplaint\models\Pccservicepi`.
 */
class PccservicepiSearch extends Pccservicepi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pcc_vn', 'data_json', 'pcc_start_service_datetime', 'pcc_end_service_datetime', 'data1', 'data2', 'hospcode', 'pi_text'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Pccservicepi::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'pcc_start_service_datetime' => $this->pcc_start_service_datetime,
            'pcc_end_service_datetime' => $this->pcc_end_service_datetime,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'pcc_vn', $this->pcc_vn])
            ->andFilterWhere(['like', 'data_json', $this->data_json])
            ->andFilterWhere(['like', 'data1', $this->data1])
            ->andFilterWhere(['like', 'data2', $this->data2])
            ->andFilterWhere(['like', 'hospcode', $this->hospcode])
            ->andFilterWhere(['like', 'pi_text', $this->pi_text]);

        return $dataProvider;
    }
}
