<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\Module;

class UserSearch extends Model
{
	public $id;
	public $username;
	public $email;
	public $status;
	public $date_from;
	public $date_to;

	public function rules()
	{
		return [
			[['id', 'status'], 'integer'],
			[['username', 'email'], 'safe'],
			[['date_from', 'date_to'], 'date', 'format' => 'php:d.m.Y'],
		];
	}

	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'created_at' => Module::t('module', 'USER_CREATED'),
			'updated_at' => Module::t('module', 'USER_UPDATED'),
			'username' => Module::t('module', 'USER_USERNAME'),
			'email' => Module::t('module', 'USER_EMAIL'),
			'status' => Module::t('module', 'USER_STATUS'),
			'date_from' => Module::t('module', 'USER_DATE_FROM'),
			'date_to' => Module::t('module', 'USER_DATE_TO'),
		];
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
		$query = User::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => [
				'defaultOrder' => ['id' => SORT_DESC],
			]
		]);

		$this->load($params);

		if (!$this->validate())
		{
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id' => $this->id,
			'status' => $this->status,
		]);

		$query
			->andFilterWhere(['like', 'username', $this->username])
			->andFilterWhere(['like', 'email', $this->email])
			->andFilterWhere(['>=', 'created_at', $this->date_from
				? strtotime($this->date_from . ' 00:00:00') : null])
			->andFilterWhere(['<=', 'created_at', $this->date_to
				? strtotime($this->date_to . ' 23:59:59') : null]);

		return $dataProvider;
	}
}
