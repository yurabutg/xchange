<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class CurrencysTable extends Table
{

    public $model = 'Currencys';

    public $contain = ['CurrencysTypes'];

    public function initialize(array $config)
    {
        $this->hasOne('CurrencysTypes', [
            'className' => 'CurrencysTypes',
            'foreignKey' => 'id',
            'bindingKey' => 'currency_type_id',
            'propertyName' => 'currency_type',
        ]);
    }

    public function getAll()
    {
        $options = [
            'contain' => $this->contain
        ];

        $results = $this->find('all', $options);
        if (!is_null($results) && !empty($results)) {
            $results = $results->toArray();
        }
        return $results;
    }

    public function getByCurrencyTypeName($type_name = null)
    {
        $results = [];
        if (!is_null($type_name)) {
            $options = [
                'contain' => $this->contain,
                'conditions' => ['CurrencysTypes.name' => $type_name]
            ];
            $results = $this->find('all', $options);
            if (!is_null($results) && !empty($results)) {
                $results = $results->toArray();
            }
        }
        return $results;
    }

}
